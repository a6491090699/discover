<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class StoreOutItem extends Model
{
    use HasDateTimeFormatter;
    protected $table = 'store_out_items';
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(ProductModel::class);
    }

    public function sku()
    {
        return $this->belongsTo(ProductSkuModel::class, 'sku_id');
    }
}
