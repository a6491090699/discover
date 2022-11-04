<?php
namespace App\Observers;

use App\Models\StockHistoryModel;
use App\Models\StoreOut;
use App\Models\StoreOutItem;
use Dcat\Admin\Admin;
use Illuminate\Support\Facades\DB;

class StoreOutObserver
{
    /**
     * Handle the sale out order model "created" event.
     *
     * @param  \App\Models\StoreOut $storeOut
     * @return void
     */
    public function created(StoreOut $storeOut): void
    {
        //
    }

    /**
     * Handle the sale out order model "updated" event.
     *
     * @param  \App\Models\StoreOut $storeOut
     * @return void
     */
    public function updated(StoreOut $storeOut): void
    {
        //
    }

    /**
     * Handle the sale out order model "deleted" event.
     *
     * @param  \App\Models\StoreOut $storeOut
     * @return void
     */
    public function deleted(StoreOut $storeOut): void
    {
        //
    }

    /**
     * Handle the sale out order model "restored" event.
     *
     * @param  \App\Models\StoreOut $storeOut
     * @return void
     */
    public function restored(StoreOut $storeOut): void
    {
        //
    }

    /**
     * Handle the sale out order model "force deleted" event.
     *
     * @param  \App\Models\StoreOut $storeOut
     * @return void
     */
    public function forceDeleted(StoreOut $storeOut): void
    {
        //
    }

    /**
     * @param StoreOut $storeOut
     */
    public function creating(StoreOut $storeOut): void
    {
        $storeOut->user_id = Admin::user()->id;
    }

    public function saving(StoreOut $storeOut): void
    {
        if ($storeOut->isDirty('status')
            && (int)$storeOut->status === StoreOut::STATUS_OUT
            && (int)$storeOut->review_status === StoreOut::REVIEW_STATUS_OK
        ) {
            $storeOut->items->each(function (StoreOutItem $storeOutItem) use ($storeOut) {
                
                StockHistoryModel::create([
                    'sku_id'          => $storeOutItem->sku_id,
                    'out_position_id' => 0,
                    'store_id'       => $storeOut->store_id,
                    // 'order_id'        => $storeOut->order_id,
                    // 'order_type'      => $storeOut->order_type,
                    'cost_price'      => 0,
                    'type'            => StockHistoryModel::STORE_OUT_TYPE,
                    'flag'            => StockHistoryModel::OUT,
                    'with_order_no'   => $storeOut->sn,
                    'out_num'         => $storeOutItem->actual_num,
                    'out_price'       => $storeOutItem->price,
                    'user_id'         => Admin::user()->id,
                ]);
            });
            //置为已发出
            $storeOut->order->status = $storeOut->order::STATUS_SEND;
            $storeOut->order->save();
            
        }
    }
}
