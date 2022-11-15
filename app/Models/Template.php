<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    const TYPE_SHENPI = 1;
    const TYPE_HETONG = 2;
    const TYPE_AGREEMENT = 3;
    const TYPE_LIST = [
        self::TYPE_SHENPI =>'审批票证模板',
        self::TYPE_HETONG =>'合同模板',
        self::TYPE_AGREEMENT =>'框架协议模板',
    ];

    const STATUS_OPEN = 1;
    const STATUS_CLOSE = 0;
    const STATUS_LIST = [
        self::STATUS_CLOSE =>'禁用',
        self::STATUS_OPEN =>'启用',
    ];
    const STATUS_COLOR = [
        self::STATUS_OPEN      => 'success',
        self::STATUS_CLOSE => 'gray',
    ];


    public function getFieldsAttribute($fields)
    {
        return array_values(json_decode($fields, true) ?: []);
    }

    public function setFieldsAttribute($fields)
    {
        $this->attributes['fields'] = json_encode(array_values($fields));
    }
}
