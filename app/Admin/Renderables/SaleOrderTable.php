<?php

namespace App\Admin\Renderables;

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
        ])->check()->get()->map(function (SaleOrderModel $model, int $key) {
            return [
                $model->id,
                $model->sn,
            ];
        })->toArray();

        $titles = [
            'Id',
            '合同编号',
            
        ];

        return Table::make($titles, $batch_stock);
    }
}