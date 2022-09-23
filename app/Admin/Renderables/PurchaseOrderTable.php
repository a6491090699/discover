<?php

namespace App\Admin\Renderables;

use App\Admin\Repositories\PurchaseOrder;
use App\Models\PurchaseOrderModel;
use App\Models\SupplierModel;
use Dcat\Admin\Grid;
use Dcat\Admin\Support\LazyRenderable;
use Dcat\Admin\Widgets\Table;

class PurchaseOrderTable extends LazyRenderable
{
    public function render()
    {
        $id = $this->key;
        $batch_stock = PurchaseOrderModel::where([
            'frame_contract_id' =>  $id,
        ])->get()->map(function (PurchaseOrderModel $model, int $key) {
            $suppliers = SupplierModel::pluck('name','id')->toarray();
            return [
                $model->id,
                $model->order_no,
                $suppliers[$model->supplier_id],
                $model->total_money,
            ];
        })->toArray();

        $titles = [
            'Id',
            '合同编号',
            '供应商',
            '合同金额',

        ];

        return Table::make($titles, $batch_stock);
    }
}
