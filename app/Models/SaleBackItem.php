<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleBackItem extends BaseModel
{
	use HasDateTimeFormatter;
    protected $table = 'sale_back_items';

    protected $with = ['sku'];
    
    public function sku(): BelongsTo
    {
        return $this->belongsTo(ProductSkuModel::class, 'sku_id');
    }

}
