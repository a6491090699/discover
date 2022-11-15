<?php

/*
 * // +----------------------------------------------------------------------
 * // | erp
 * // +----------------------------------------------------------------------
 * // | Copyright (c) 2006~2020 erp All rights reserved.
 * // +----------------------------------------------------------------------
 * // | Licensed ( LICENSE-1.0.0 )
 * // +----------------------------------------------------------------------
 * // | Author: yy <649109069@qq.com>
 * // +----------------------------------------------------------------------
 */

namespace App\Admin\Repositories;

use App\Models\SkuStockBatchModel;
use App\Models\SkuStockModel as Model;
use App\Models\StockHistoryModel;
use App\Models\Store;
use Dcat\Admin\Repositories\EloquentRepository;

class SkuStock extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    public function countNum($sku_id)
    {
        $pd = SkuStockBatchModel::query()->with('stockHistory')->whereHas('stockHistory', function ($query) {
            $query->where('flag', StockHistoryModel::INVENTORY);
        })->where([
            'sku_id' => $sku_id,
        ])->orderBy('id', 'desc')->get();
        $pd_group = $pd->mapToGroups(function ($item, $key) {
            return [$item->stockHistory->batch_no => $item];
        })->toArray();
        $pd_order_no = $pd->pluck('batch_no')->toArray();
        $link_in_order_no = StockHistoryModel::whereIn('with_order_no', $pd_order_no)->pluck('batch_no')->toArray();

        //盘点单的数量  .. 有可能多张盘点单 
        $pd_num = 0;
        foreach ($pd_group as $item) {
            $pd_num += $item[0]['num'];
        }

        $out = SkuStockBatchModel::query()->whereHas('stockHistory', function ($query) {
            $query->where('flag', StockHistoryModel::OUT);
        })->where([
            'sku_id' => $sku_id,
        ])->get();
        $out_num = $out->sum('num');
        $in = SkuStockBatchModel::query()->whereHas('stockHistory', function ($query) {
            $query->where('flag', StockHistoryModel::IN);
        })->where([
            'sku_id' => $sku_id,
        ])->whereNotIn('batch_no', $link_in_order_no)->get();
        $in_num = $in->sum('num');
        $num = $pd_num + $in_num + $out_num;
        return $num;
    }

    public function countStoreNum()
    {
        $pd = SkuStockBatchModel::query()->with('stockHistory')->whereHas('stockHistory', function ($query) {
            $query->where('flag', StockHistoryModel::INVENTORY);
        })->orderBy('id', 'desc')->get();
        $pd_store = $pd->groupBy('store_id');
        
        $pd_order_no = $pd->pluck('batch_no')->toArray();
        $link_in_order_no = StockHistoryModel::whereIn('with_order_no', $pd_order_no)->pluck('batch_no')->toArray();

        $out = SkuStockBatchModel::query()->whereHas('stockHistory', function ($query) {
            $query->where('flag', StockHistoryModel::OUT);
        })->get();
        $out_store = $out->groupBy('store_id');
        $in = SkuStockBatchModel::query()->whereHas('stockHistory', function ($query) {
            $query->where('flag', StockHistoryModel::IN);
        })->whereNotIn('batch_no', $link_in_order_no)->get();
        $in_store = $in->groupBy('store_id');


        $store_list = Store::get(['title as name' ,'id']);
        // dd($store_list->toArray());
        $store_list->transform(function($item,$key)use($pd_store,$in_store,$out_store){
            $pd_num = 0;
            $in_num = 0;
            $out_num = 0;
            // dd($pd_store->toArray());
            $pd_group = $pd_store[$item->id]->mapToGroups(function ($item) {
                return [$item->stockHistory->batch_no => $item];
            })->toArray();
            foreach ($pd_group as $i) {
                $pd_num += $i[0]['num'];
            }

            $in_num = array_sum(data_get($in_store->toArray() , $item->id.'.*.num'));
            $out_num = array_sum(data_get($out_store->toArray() , $item->id.'.*.num'));
            $item->value = $in_num + $out_num + $pd_num;
            return $item;
        });

        return $store_list->toArray();
    }
}
