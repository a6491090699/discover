<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class StoreOutItem extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'store_out_items';
    
}
