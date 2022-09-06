<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    const STATUS_DOING = 1;
    const STATUS_DONE = 2;
    const STATUS_LIST  = [
        self::STATUS_DOING => '正在进行',
        self::STATUS_DONE => '已完成',
    ];
}
