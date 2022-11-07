<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;
    
    const STATUS_NO_SEND = 0;
    const STATUS_DELIVERYING = 1;
    const STATUS_RECEIVE = 2;
    const STATUS_LIST  = [
        self::STATUS_NO_SEND => '未发货',
        self::STATUS_DELIVERYING => '运送中',
        self::STATUS_RECEIVE => '已收货',
    ];

    const TYPE_DIAOBO = 'allocations';
    const TYPE_BUY = 'purchase_order';
    const TYPE_BACK = 'sale_back_orders';
    const TYPE_OTHER = 'other';
    const TYPE_DIAOBO_OUT = 'allocations';
    const TYPE_SELL_OUT = 'sale_out_order';
    const TYPE_BUY_OUT = 'purchase_order_backs';
    const TYPE_OTHER_OUT = 'other';
    const TYPE_LIST = [
        self::TYPE_DIAOBO => '调拨入库',
        self::TYPE_BUY => '采购入库',
        self::TYPE_BACK => '客户退货入库',
        self::TYPE_OTHER => '其他入库',
        self::TYPE_DIAOBO_OUT => '调拨出库',
        self::TYPE_SELL_OUT => '销售出库',
        self::TYPE_BUY_OUT => '退货供应商出库',
        self::TYPE_OTHER_OUT => '其他出库',
    ];

    public function order()
    {
        return $this->morphTo();
    }


    

}
