<?php

namespace App\Admin\Repositories;

use App\Models\PurchaseOrderModel;
use App\Models\StoreIn as Model;
use App\Models\StoreIn as ModelsStoreIn;
use Dcat\Admin\Form;
use Dcat\Admin\Repositories\EloquentRepository;
use Illuminate\Support\Facades\Log;

class StoreIn extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    public function store(Form $form)
    {
        $ret = parent::store($form);


        return $ret;
    }

    // public function getFormColumns()
    // {
    //     return [$this->getKeyName(), 'name', 'title', 'created_at'];
    // }

    public function ifAllIn($storein_id)
    {
        $obj = ModelsStoreIn::find($storein_id);

        $order = $obj->order;
        $num_info = [];
        $order->storeIn->map(function ($item, $key) use (&$num_info) {
            $infos = $item->items()->selectRaw('sum(actual_num) as nums , sku_id')->groupBy('sku_id')->get();
            foreach ($infos as $i) {
                if (!isset($num_info[$i->sku_id])) {
                    $num_info[$i->sku_id] = 0;
                }
                $num_info[$i->sku_id] += $i->nums;
            }
        });
        $should_info = [];
        $should = $order->items()->selectRaw('sum(should_num) as nums , sku_id')->groupBy('sku_id')->get();
        foreach ($should as $i) {
            if (!isset($should_info[$i->sku_id])) {
                $should_info[$i->sku_id] = 0;
            }
            $should_info[$i->sku_id] += $i->nums;
        }
        if ($num_info == $should_info) {
            //入库操作
            return true;
        }
        return false;
    }
}
