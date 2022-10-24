<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Flow extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    const CHECK_TYPE_ZHIDING = 1;
    // const TYPE_OTHER = 2;
    const CHECK_TYPE_LIST  = [
        self::CHECK_TYPE_ZHIDING => '多人会签',
        // self::TYPE_OTHER => '其他',
    ];

    public function getFLowListAttribute($fields)
    {
        return array_values(json_decode($fields, true) ?: []);
    }

    public function setFLowListAttribute($fields)
    {
        $this->attributes['flow_list'] = json_encode(array_values($fields));
    }

    // public function getFLowListAttribute($extra)
    // {
    //     return array_values(json_decode($extra, true) ?: []);
    // }

    // public function setFLowListAttribute($extra)
    // {
    //     $this->attributes['flow_list'] = json_encode(array_values($extra));
    // }


    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id');
    }
}
