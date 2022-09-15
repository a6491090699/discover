<?php
namespace App\Observers;

use App\Models\PurchaseOrderModel;
use App\Models\SkuStockModel;
use App\Models\StockHistoryModel;
use App\Models\StoreIn;
use App\Models\StoreInItem;
use Dcat\Admin\Admin;
use Illuminate\Support\Facades\DB;

class StoreInObserver
{
    /**
     * Handle the purchase in order model "created" event.
     *
     * @param  \App\Models\StoreIn $storeIn
     * @return void
     */
    public function created(StoreIn $storeIn)
    {
        //
    }

    /**
     * Handle the purchase in order model "updated" event.
     *
     * @param  \App\Models\StoreIn $storeIn
     * @return void
     */
    public function updated(StoreIn $storeIn)
    {
        //
    }

    /**
     * Handle the purchase in order model "deleted" event.
     *
     * @param  \App\Models\StoreIn $storeIn
     * @return void
     */
    public function deleted(StoreIn $storeIn)
    {
        //
    }

    /**
     * Handle the purchase in order model "restored" event.
     *
     * @param  \App\Models\StoreIn $storeIn
     * @return void
     */
    public function restored(StoreIn $storeIn)
    {
        //
    }

    /**
     * Handle the purchase in order model "force deleted" event.
     *
     * @param  \App\Models\StoreIn $storeIn
     * @return void
     */
    public function forceDeleted(StoreIn $storeIn): void
    {
        //
    }

    /**
     * @param StoreIn $storeIn
     */
    public function saving(StoreIn $storeIn): void
    {
        // dd($storeIn->isDirty('review_status') ,$storeIn->review_status , $storeIn->status);
        if ($storeIn->isDirty('status')
            && (int)$storeIn->status === StoreIn::STATUS_IN
            // && (int)$storeIn->review_status === StoreIn::REVIEW_STATUS_OK
        ) {
            $storeIn->items->each(function (StoreInItem $storeInItem) use ($storeIn) {
                $init_num = SkuStockModel::query()
                    ->where([
                        'sku_id' => $storeInItem->sku_id,
                    ])->value('num');

                StockHistoryModel::create([
                    'sku_id'         => $storeInItem->sku_id,
                    'in_position_id' => 0,
                    'store_id'       => $storeIn->store_id,
                    'cost_price'     => $storeInItem->price,
                    'type'           => StockHistoryModel::IN_STOCK_PUCHASE,
                    'order_type'     => $storeIn->order_type,
                    'flag'           => StockHistoryModel::IN,
                    'with_order_no'  => $storeIn->sn,
                    'init_num'       => $init_num ?? 0,
                    'in_num'         => $storeInItem->actual_num,
                    'in_price'       => $storeInItem->price,
                    'balance_num'    => $init_num + $storeInItem->actual_num,
                    'user_id'        => Admin::user()->id,
                ]);

            });
            //入库单入库状态 自动把采购单的状态置为已收货
            $storeIn->order->status = $storeIn->order::STATUS_ARRIVE;
            $storeIn->order->save();
            
        }
    }

    /**
     * @param StoreIn $storeIn
     */
    public function creating(StoreIn $storeIn): void
    {
        $storeIn->user_id = Admin::user()->id;
    }

}
