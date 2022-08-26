<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'product_categories';
    
}
