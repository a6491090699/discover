<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;


    const STATUS_NO = '0';
    const STATUS_ING = '1';
    const STATUS_SUCCESS = '2';
    const STATUS_FAIL = '3';
    const STATUS_REVOKE = '4';

    const STATUS_LIST = [
        self::STATUS_NO => '未审核',
        self::STATUS_ING => '审核中',
        self::STATUS_SUCCESS => '审核成功',
        self::STATUS_FAIL => '审核失败',
        self::STATUS_REVOKE => '撤回',
    ];

    public function flowSteps()
    {
        return $this->hasMany(FlowStep::class, 'approval_id');
    }

    public function flowRecords()
    {
        return $this->hasMany(FlowRecord::class, 'approval_id');
    }

    public function flow()
    {
        return $this->belongsTo(Flow::class, 'flow_id');
    }

    public function getCheckUserIdsAttribute($fields)
    {
        return array_values(json_decode($fields, true) ?: []);
    }

    public function setCheckUserIdsAttribute($fields)
    {
        $this->attributes['check_user_ids'] = json_encode(array_values($fields));
    }
}
