<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    public function getFieldsAttribute($fields)
    {
        return array_values(json_decode($fields, true) ?: []);
    }

    public function setFieldsAttribute($fields)
    {
        $this->attributes['fields'] = json_encode(array_values($fields));
    }
}
