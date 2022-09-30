<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    public function paylog()
    {
        return $this->belongsTo(SellPayLog::class,'sell_pay_log_id');
    }
    public function user()
    {
        return $this->belongsTo(AdminUser::class , 'user_id');
    }
}
