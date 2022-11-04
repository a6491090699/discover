<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SaleBackOrder extends PurchaseBaseModel
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'sale_back_orders';

    public function items()
    {
        return $this->hasMany(SaleBackItem::class, 'order_id');
    }
    
    public function saleOrder()
    {
        return $this->belongsTo(SaleOrderModel::class ,'sale_back_order_id');
    }

    public function storeIn()
    {
        return $this->morphMany(StoreIn::class ,'order');
    }
}
