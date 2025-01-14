<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class StoreIn extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    const STATUS_IN = 1;
    const STATUS_NOT_IN = 2;
    const STATUS_LIST = [
        self::STATUS_NOT_IN => '未入库',
        self::STATUS_IN => '已入库',
    ];

    const TYPE_DIAOBO = 'allocations';
    const TYPE_BUY = 'purchase_order';
    const TYPE_BACK = 'sale_in_order';
    const TYPE_OTHER = 'other';
    const TYPE_LIST = [
        self::TYPE_DIAOBO => '调拨入库',
        self::TYPE_BUY => '采购入库',
        self::TYPE_BACK => '客户退货入库',
        self::TYPE_OTHER => '其他入库',
    ];


    protected $table = 'store_ins';
    protected $guarded = [];


    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function items()
    {
        return $this->hasMany(StoreInItem::class);
    }

    public function order()
    {
        return $this->morphTo();
    }
}
