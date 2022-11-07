<?php

/*
 * // +----------------------------------------------------------------------
 * // | erp
 * // +----------------------------------------------------------------------
 * // | Copyright (c) 2006~2020 erp All rights reserved.
 * // +----------------------------------------------------------------------
 * // | Licensed ( LICENSE-1.0.0 )
 * // +----------------------------------------------------------------------
 * // | Author: yxx <1365831278@qq.com>
 * // +----------------------------------------------------------------------
 */

namespace App\Observers;

use App\Models\SkuStockBatchModel;
use App\Models\SkuStockModel;
use App\Models\StockHistoryModel;

class SkuStockBatchObserver
{
    /**
     * @param SkuStockBatchModel $skuStockBatchModel
     */
    public function saved(SkuStockBatchModel $skuStockBatchModel): void
    {
        //商品库存操作  yytodo
        //入库-出库
        //盘点优先级大于入库   
        $pd = SkuStockBatchModel::query()->with('stockHistory')->whereHas('stockHistory', function ($query) {
            $query->where('flag', StockHistoryModel::INVENTORY);
        })->where([
            'sku_id' => $skuStockBatchModel->sku_id,
        ])->orderBy('id','desc')->get();
        $pd_group = $pd->mapToGroups(function ($item, $key) {
            return [$item->stockHistory->batch_no => $item];
        })->toArray();
        $pd_order_no = $pd->pluck('batch_no')->toArray();
        $link_in_order_no = StockHistoryModel::whereIn('with_order_no' , $pd_order_no)->pluck('batch_no')->toArray();
        
        //盘点单的数量  .. 有可能多张盘点单 
        $pd_num = 0;
        foreach ($pd_group as $item) {
            $pd_num += $item[0]['num'];
        }

        $out = SkuStockBatchModel::query()->whereHas('stockHistory', function ($query) {
            $query->where('flag', StockHistoryModel::OUT);
        })->where([
            'sku_id' => $skuStockBatchModel->sku_id,
        ])->get();
        $out_num = $out->sum('num');
        $in = SkuStockBatchModel::query()->whereHas('stockHistory', function ($query) {
            $query->where('flag', StockHistoryModel::IN);
        })->where([
            'sku_id' => $skuStockBatchModel->sku_id,
        ])->whereNotIn('batch_no',$link_in_order_no)->get();
        $in_num = $in->sum('num');
        $num = $pd_num + $in_num + $out_num;
        // $transfer = SkuStockBatchModel::query()->whereHas('stockHistory', function ($query) {
        //     $query->where('flag', StockHistoryModel::TRANSFER);
        // })->where([
        //     'sku_id' => $skuStockBatchModel->sku_id,
        // ])->get();
        SkuStockModel::updateOrCreate(
            [
                'sku_id' => $skuStockBatchModel->sku_id,
            ],
            ['num' => $num]
        );
    }
}
