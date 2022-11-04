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
        $pd = SkuStockBatchModel::query()->whereHas('stockHistory', function ($query) {
            $query->where('flag', StockHistoryModel::INVENTORY);
        })->where([
            'sku_id' => $skuStockBatchModel->sku_id,
            // 'percent' => $skuStockBatchModel->percent,
            // 'standard'       => $skuStockBatchModel->standard,
        ])->get();
        $pd_order_no = $pd->pluck('batch_no')->toArray();

        $out = SkuStockBatchModel::query()->whereHas('stockHistory', function ($query) {
            $query->where('flag', StockHistoryModel::OUT);
        })->where([
            'sku_id' => $skuStockBatchModel->sku_id,
            // 'percent' => $skuStockBatchModel->percent,
            // 'standard'       => $skuStockBatchModel->standard,
        ])->get();

        $in = SkuStockBatchModel::query()->whereHas('stockHistory', function ($query) {
            $query->where('flag', StockHistoryModel::IN);
        })->where([
            'sku_id' => $skuStockBatchModel->sku_id,
            // 'percent' => $skuStockBatchModel->percent,
            // 'standard'       => $skuStockBatchModel->standard,
        ])->get();

        $TRANSFER = SkuStockBatchModel::query()->whereHas('stockHistory', function ($query) {
            $query->where('flag', StockHistoryModel::TRANSFER);
        })->where([
            'sku_id' => $skuStockBatchModel->sku_id,
            // 'percent' => $skuStockBatchModel->percent,
            // 'standard'       => $skuStockBatchModel->standard,
        ])->get();
        $pd_num = $pd->sum('num');
        $out_num = $pd->sum('num');

        //除去盘点操作  
        $num = SkuStockBatchModel::query()->whereHas('stockHistory', function ($query) {
            $query->where('type', '<>', StockHistoryModel::INVENTORY_TYPE);
        })->where([
            'sku_id' => $skuStockBatchModel->sku_id,
            // 'percent' => $skuStockBatchModel->percent,
            // 'standard'       => $skuStockBatchModel->standard,
        ])->sum('num');
        SkuStockModel::updateOrCreate(
            [
                'sku_id' => $skuStockBatchModel->sku_id,
                // 'percent' => $skuStockBatchModel->percent,
                // 'standard'       => $skuStockBatchModel->standard,
            ],
            ['num' => $num]
        );
    }
}
