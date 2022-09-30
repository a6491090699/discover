<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    const TYPE_AREA = 1;
    const TYPE_WEIGHT = 2;

    const TYPE_LIST = [
        self::TYPE_AREA => '按面积计费',
        self::TYPE_WEIGHT => '按重量计费'
    ];

    public function storeCompany()
    {
        return $this->belongsTo(StoreCompany::class);
    }
}
