<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseOrderBack extends SaleBaseModel
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'purchase_order_backs';


    /**
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(PurchaseBackItem::class, 'purchase_order_back_id');
    }

    /**
     * @return BelongsTo
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(SupplierModel::class, 'supplier_id');
    }

    public function storeOut()
    {
        return $this->morphOne(StoreOut::class ,'order');
    }
}
