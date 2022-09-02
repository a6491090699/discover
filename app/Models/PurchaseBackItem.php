<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseBackItem extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'purchase_back_items';
    protected $guarded = [];
    
    public function sku(): BelongsTo
    {
        return $this->belongsTo(ProductSkuModel::class, 'sku_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }

}
