<?php

namespace App\Admin\Repositories;

use App\Models\FrameContract as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class FrameContract extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    public function create_sn()
    {
        $number = create_uniqid_sn('frame_contract');
        return $number;
    }

    public function update_autoincrement()
    {
        increment_uniqid_sn('frame_contract');
    }

    //应付款  采购付款记录+
    public function accountPayable(Model $model)
    {
        // $check_at = now();
        $purchases = $model->purchaseOrders;
        $purchases->map(function($item , $key)use($model){
            $item->paylog->map(function($i , $k)use($model){
                if($i->feeType->has_caozuo){
                    //计算操作费
                    $i->caozuo = $i->this_time_money * $model->caozuo_rate;
                }
                if($i->feeType->has_zhanyong){
                    //计算资金占用费
                    $i->zhanyong = $i->this_time_money * $model->zhanyong_rate;
                }
                $i->check_at = now();
                $i->save();
            });
        });
    }

    //应收款  销售回款记录+
    public function accountReceivable(Model $model)
    {
        $sale_orders = $model->saleOrders;
        $sale_orders->map(function($item , $key)use($model){
            $item->paylog->map(function($i , $k)use($model){
                if($i->feeType->has_caozuo){
                    //计算操作费
                    $i->caozuo = $i->this_time_money * $model->caozuo_rate;
                }
                if($i->feeType->has_zhanyong){
                    //计算资金占用费
                    $i->zhanyong = $i->this_time_money * $model->zhanyong_rate;
                }
                $i->check_at = now();
                $i->save();
            });
        });
    }

    public function settleDetail(Model $model)
    {
        

        //获取采购合同数据以及支付记录+获取入库记录
        $purchases = $model->purchaseOrders;
        $purchase_settle_data = [];
        $purchases->map(function($item)use(&$purchase_settle_data){
            $purchase_settle_data[] = app(PurchaseOrder::class)->settleData($item);
        });
        
        //获取销售合同数据以及支付记录 + 获取出库记录
        $sale_orders = $model->saleOrders;
        $sale_settle_data = [];
        $sale_orders->map(function($item)use(&$sale_settle_data){
            $sale_settle_data[] = app(SaleOrder::class)->settleData($item);
        });
        
    }
}
