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

use App\Models\PurchaseOrderModel as Model;
use App\Models\StoreIn;
use Dcat\Admin\Repositories\EloquentRepository;

class PurchaseOrder extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    public function selectItems()
    {
        return $this->eloquentClass::pluck('order_no', 'id')->toarray();
    }

    //合同下面所有的结算数据
    public function settleData(Model $order)
    {
        //支付记录
        $pay_logs = $order->paylog()->oldest('pay_at')->get();
        //入库记录
        $store_in_logs = $order->storeIn()->where('status', StoreIn::STATUS_IN)->oldest('in_at')->get();

        return compact('order', 'pay_logs', 'store_in_logs');
    }
}
