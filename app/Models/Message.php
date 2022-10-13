<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    public function fromUser()
    {
        return $this->belongsTo(AdminUser::class ,'from_uid');
    }

    public function toUser()
    {
        return $this->belongsTo(AdminUser::class ,'to_uid');
    }
}
