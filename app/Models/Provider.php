<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    const STATUS_OPEN = 1;
    const STATUS_CLOSE = 2;

    const TYPE_WULIU = 1;
    const TYPE_HUODAI = 2;
    const TYPE_BAOGUAN = 2;
    
    const STATUS_LIST = [
        self::STATUS_OPEN   => '启用',
        self::STATUS_CLOSE    => '禁用',
    ];

    const TYPE_LIST = [
        self::TYPE_WULIU   => '物流',
        self::TYPE_HUODAI    => '货代',
        self::TYPE_BAOGUAN    => '报关行',
    ];

    const STATUS_COLOR = [
        self::STATUS_OPEN      => 'success',
        self::STATUS_CLOSE => 'gray',
    ];
}
