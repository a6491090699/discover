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

}
