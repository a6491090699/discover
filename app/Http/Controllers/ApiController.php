<?php

namespace App\Http\Controllers;

use App\Models\Allocation;
use App\Models\PurchaseOrderBack;
use App\Models\PurchaseOrderModel;
use App\Models\SaleInOrderModel;
use App\Models\SaleOutOrderModel;
use App\Models\StoreIn;
use App\Models\StoreOut;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function orders(Request $request)
    {
        $val = $request->get('q');
        switch ($val) {
            case StoreIn::TYPE_BACK:
                $list = SaleInOrderModel::where('status', SaleInOrderModel::STATUS_WAIT)->get(['id', 'order_no as text']);
                break;
            case StoreIn::TYPE_BUY:
                $list = PurchaseOrderModel::where('status', PurchaseOrderModel::STATUS_WAIT)->get(['id', 'order_no as text']);
                break;
            case StoreIn::TYPE_DIAOBO:
                $list = Allocation::where('status', Allocation::STATUS_DOING)->get(['id','sn as text']);
                break;
            case StoreOut::TYPE_SELL_OUT:
                $list = PurchaseOrderBack::where('status', PurchaseOrderBack::STATUS_UNSEND)->get(['id', 'sn as text']);
                break;
            case StoreOut::TYPE_BUY_OUT:
                $list = SaleOutOrderModel::where('status', SaleOutOrderModel::STATUS_DOING)->get(['id', 'order_no as text']);
                break;
            case StoreOut::TYPE_DIAOBO_OUT:
                $list = Allocation::where('status', Allocation::STATUS_DOING)->get(['id','sn as text']);
                break;
            default:
                $list = collect([]);
        }
        return $list->toArray();
    }
}
