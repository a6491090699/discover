<?php

namespace App\Admin\Renderables;

use App\Models\CustomerModel;
use App\Models\SaleOrderModel;
use Dcat\Admin\Support\LazyRenderable;
use Dcat\Admin\Widgets\Table;

class SaleOrderTable extends LazyRenderable
{
    public function render()
    {
        $id      = $this->key;
        $batch_stock = SaleOrderModel::where([
            'frame_contract_id' =>  $id,
        ])->get()->map(function (SaleOrderModel $model, int $key) {
            $customers = CustomerModel::pluck('name','id')->toarray();
            return [
                $model->id,
                $model->order_no,
                $customers[$model->customer_id],
                $model->total_money,
            ];
        })->toArray();

        $titles = [
            'Id',
            '合同编号',
            '客户',
            '合同金额',
        ];

        return Table::make($titles, $batch_stock);
    }
}
