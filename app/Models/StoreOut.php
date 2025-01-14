<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class StoreOut extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    const STATUS_OUT = 1;
    const STATUS_NOT_OUT = 2;
    const STATUS_LIST = [
        self::STATUS_NOT_OUT =>'未出库',
        self::STATUS_OUT =>'已出库',
    ];

    const TYPE_DIAOBO_OUT = 'allocations';
    const TYPE_SELL_OUT = 'sale_out_order';
    const TYPE_BUY_OUT = 'purchase_order_backs';
    const TYPE_OTHER_OUT = 'other';
    const TYPE_LIST = [
        self::TYPE_DIAOBO_OUT =>'调拨出库',
        self::TYPE_SELL_OUT =>'销售出库',
        self::TYPE_BUY_OUT =>'退货供应商出库',
        self::TYPE_OTHER_OUT =>'其他出库',
    ];


    protected $table = 'store_outs';
    protected $guarded = [];

    
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function order()
    {
        return $this->morphTo();
    }

    
}
