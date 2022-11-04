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

namespace App\Admin\Renderables;

use App\Models\SkuStockBatchModel;
use App\Models\StoreIn;
use Dcat\Admin\Support\LazyRenderable;
use Dcat\Admin\Widgets\Table;

class SkuStockBatchTable extends LazyRenderable
{
    public function render()
    {
        $sku_id      = $this->sku_id;
        $batch_stock = SkuStockBatchModel::with('sku.product.unit','store','storeIn.order')->where([
            'sku_id' =>  $sku_id,
            // 'percent' => $this->percent,
        ])->where('num', ">", 0)->get()->map(function (SkuStockBatchModel $batchModel, int $key) {
            return [
                $key + 1,
                $batchModel->sku->product->item_no,
                $batchModel->sku->product->name ?? '',
                $batchModel->sku->product->unit->name ?? '',
                $batchModel->sku->product->type_str ?? '',
                $batchModel->sku->attr_value_ids_str ?? '',
                $batchModel->batch_no,
                $batchModel->num,
                $batchModel->store->title ?? '',
                StoreIn::TYPE_LIST[$batchModel->storeIn->order_type ],
                $batchModel->storeIn->order->order_no??$batchModel->storeIn->sn,
            ];
        })->toArray();

        $titles = [
            'Id',
            '产品编号',
            '产品名称',                                
            '单位',
            '类型',
            '属性',
            '入库单号',
            '库存数量',
            '仓库',
            '订单类型',
            '关联订单号',
        ];

        return Table::make($titles, $batch_stock);
    }
}
