<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class StoreInItem extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'store_in_items';
    protected $guarded = [];
    
    public function product()
    {
        return $this->belongsTo(ProductModel::class);
    }

    public function sku()
    {
        return $this->belongsTo(ProductSkuModel::class , 'sku_id');
    }
}
