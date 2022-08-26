<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    CONST TYPE_AREA = 1 ;
    CONST TYPE_WEIGHT = 2 ;

    CONST TYPE_LIST = [
        self::TYPE_AREA => '按面积计费',
        self::TYPE_WEIGHT => '按重量计费'
    ];

}
