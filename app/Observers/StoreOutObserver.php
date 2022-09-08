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
        if ($storeOut->isDirty('review_status')
            && (int)$storeOut->review_status === StoreOut::REVIEW_STATUS_OK
            && (int)$storeOut->status === StoreOut::STATUS_OUT
        ) {
            $storeOut->items->each(function (StoreOutItem $storeOutItem) use ($storeOut) {
                
                StockHistoryModel::create([
                    'sku_id'          => $storeOutItem->sku_id,
                    'out_position_id' => 0,
                    'store_id'       => $storeOut->store_id,
                    'order_id'        => $storeOut->order_id,
                    'order_type'      => $storeOut->order_type,
                    'cost_price'      => 0,
                    'type'            => 0,
                    'flag'            => StockHistoryModel::OUT,
                    'with_order_no'   => $storeOut->sn,
                    'init_num'        => 0,
                    'out_num'         => $storeOutItem->actual_num,
                    'out_price'       => $storeOutItem->price,
                    'balance_num'     => $storeOutItem->actual_num,
                    'user_id'         => Admin::user()->id,
                ]);
            });
            //置为已发出
            $storeOut->order->status = $storeOut->order::STATUS_SEND;
            $storeOut->order->save();
            $storeOut->apply_at = now();
            $storeOut->amount()->create([
                'customer_id' => $storeOut->customer_id,
                'should_amount' => $storeOut->items->reduce(function (float $amount, StoreOutItem $itemModel) {
                    $sumPrice = bcmul($itemModel->price, $itemModel->actual_num, 5);
                    return bcadd($sumPrice, $amount, 5);
                }, 0),
            ]);
        }
    }
}
