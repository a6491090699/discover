<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Dcat\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;
    use ModelTree;

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    

}
