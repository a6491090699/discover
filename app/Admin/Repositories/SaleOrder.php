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

namespace App\Admin\Repositories;

use App\Models\CustomerModel;
use App\Models\FeeType;
use App\Models\SaleOrderModel as Model;
use App\Models\SellPayLog;
use App\Models\StoreOut;
use Carbon\Carbon;
use Dcat\Admin\Repositories\EloquentRepository;
use Illuminate\Support\Collection;

class SaleOrder extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    /**
     * @return Collection
     */
    public function customer(): Collection
    {
        return CustomerModel::OrderBy('id', 'desc')->pluck('name', 'id');
    }

    public function selectItems()
    {
        return $this->eloquentClass::pluck('order_no', 'id')->toArray();
    }

    public function calculateFee($data)
    {
        $order = $this->eloquentClass::find($data['sale_order_id']);
        $fee_type = FeeType::where('id', $data['fee_type_id'])->first();
        $caozuo_rate = $order->frameContract->caozuo_rate;
        $zhanyong_rate = $order->frameContract->zhanyong_rate;
        $pre_pay = $order->purchaseOrder->payLog()->where('fee_type_id', 1)->first();
        $time_range = Carbon::create($data['pay_at'])->diffInMonths($pre_pay->pay_at);
        $updates = [];
        if ($fee_type->has_caozuo) {
            $updates['caozuo'] =  $data['this_time_money'] * $caozuo_rate * $time_range;
        }
        if ($fee_type->has_zhanyong) {
            $updates['zhanyong'] =  $data['this_time_money'] * $zhanyong_rate * $time_range;
        }

        SellPayLog::where('id', $data['id'])->update($updates);
    }

    //合同下面所有的结算数据
    public function settleData(Model $order)
    {
        //支付记录
        $pay_logs = $order->paylog()->oldest('pay_at')->get();
        //出库记录
        $store_out_logs = $order->storeIn()->where('status',StoreOut::STATUS_OUT)->oldest('out_at')->get();
        
        return compact('order','pay_logs','store_out_logs');
    }
}
