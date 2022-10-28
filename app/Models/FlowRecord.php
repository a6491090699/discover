<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class FlowRecord extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'flow_records';
    protected $guarded = [];

    const STATUS_DEFAULT = 0;
    const STATUS_PASS = 1;
    const STATUS_NOPASS = 2;
    const STATUS_LIST = [
        self::STATUS_DEFAULT => '未审核',
        self::STATUS_PASS => '审批通过',
        self::STATUS_NOPASS => '审批失败',
    ];
}
