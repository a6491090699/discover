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
        self::STATUS_NOT_IN =>'未入库',
        self::STATUS_IN =>'已入库',
    ];

    protected $table = 'store_ins';

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
