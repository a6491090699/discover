<?php

namespace App\Http\Controllers;

use App\Admin\Repositories\Department as RepositoriesDepartment;
use App\Admin\Repositories\Message;
use App\Services\AdminUserService;
use App\Services\PermissionService;
use App\Services\RoleService;
use App\Models\Allocation;
use App\Models\Department;
use App\Models\PurchaseOrderBack;
use App\Models\PurchaseOrderModel;
use App\Models\SaleBackOrder;
use App\Models\SaleInOrderModel;
use App\Models\SaleOrderModel;
use App\Models\StoreIn;
use App\Models\StoreOut;
use Illuminate\Http\Request;

class PubController extends Controller
{
    //获取用户菜单
    public function base(Request $request)
    {
        $permissions = $request->user()->allPermissions();
        $userinfo = $request->user();
        //审批消息 todo

        return $this->_success(compact('permission', 'userinfo'));
    }
    public function menu(Request $request)
    {
        $permissions = $request->user()->allPermissions();
        return $this->_success($permissions);
    }

    public function roles()
    {
        $list = app(RoleService::class)->selectItem();
        return $this->_success($list->toArray());
    }

    public function permissions()
    {
        // $list = app(PermissionService::class)->selectItem();
        $role = request()->query('role', 0);
        if ($role) {
            $tree = app(PermissionService::class)->getRolePermission($role);
        } else {
            $tree = app(PermissionService::class)->getAllPermission();
        }
        return $this->_success($tree);
    }

    public function users()
    {
        $list = app(AdminUserService::class)->selectItem();
        return $this->_success($list->toArray());
    }

    public function urls()
    {
        $list = app(PermissionService::class)->getRoutes();
        return $this->_success($list);
    }

    public function orders(Request $request)
    {
        $val = $request->get('q');
        switch ($val) {
            case StoreIn::TYPE_BACK:
                $list = SaleBackOrder::where('status', SaleBackOrder::STATUS_WAIT)->review()->get(['id', 'sn as text']);
                break;
            case StoreIn::TYPE_BUY:
                $list = PurchaseOrderModel::where('status', PurchaseOrderModel::STATUS_WAIT)->review()->get(['id', 'order_no as text']);
                break;
            case StoreIn::TYPE_DIAOBO:
                $list = Allocation::where('status', Allocation::STATUS_DOING)->review()->get(['id', 'sn as text']);
                break;
            case StoreOut::TYPE_SELL_OUT:
                $list = SaleOrderModel::where('status', SaleOrderModel::STATUS_DOING)->review()->get(['id', 'order_no as text']);
                break;
            case StoreOut::TYPE_BUY_OUT:
                $list = PurchaseOrderBack::where('status', PurchaseOrderBack::STATUS_DOING)->review()->get(['id', 'sn as text']);
                break;
            case StoreOut::TYPE_DIAOBO_OUT:
                $list = Allocation::where('status', Allocation::STATUS_DOING)->review()->get(['id', 'sn as text']);
                break;
            default:
                $list = collect([]);
        }
        return $list->toArray();
    }

    public function multiOrders(Request $request)
    {
        $val = $request->get('q');
        switch ($val) {
            case StoreIn::TYPE_BACK:
                $list = SaleBackOrder::whereIn('status', [SaleBackOrder::STATUS_WAIT, SaleBackOrder::STATUS_PART_ARRIVE, SaleBackOrder::STATUS_ARRIVE])->review()->get(['id', 'sn as text']);
                break;
            case StoreIn::TYPE_BUY:
                $list = PurchaseOrderModel::whereIn('status', [PurchaseOrderModel::STATUS_WAIT, PurchaseOrderModel::STATUS_PART_ARRIVE, PurchaseOrderModel::STATUS_ARRIVE])->review()->get(['id', 'order_no as text']);
                break;
            case StoreIn::TYPE_DIAOBO:
                $list = Allocation::whereIn('status', [Allocation::STATUS_DOING, Allocation::STATUS_DONE])->review()->get(['id', 'sn as text']);
                break;
            case StoreOut::TYPE_SELL_OUT:
                $list = SaleOrderModel::whereIn('status', [SaleOrderModel::STATUS_DOING, SaleOrderModel::STATUS_SEND])->review()->get(['id', 'order_no as text']);
                break;
            case StoreOut::TYPE_BUY_OUT:
                $list = PurchaseOrderBack::whereIn('status', [PurchaseOrderBack::STATUS_DOING, PurchaseOrderBack::STATUS_SEND])->review()->get(['id', 'sn as text']);
                break;
            case StoreOut::TYPE_DIAOBO_OUT:
                $list = Allocation::whereIn('status', [Allocation::STATUS_DOING, Allocation::STATUS_DONE])->review()->get(['id', 'sn as text']);
                break;
            default:
                $list = collect([]);
        }
        return $list->toArray();
    }


    public function messageRead()
    {
        $id = request()->input('id');
        if (request()->filled('id')) {
            if (app(Message::class)->read($id)) {
                return response()->json(['status' => 1, 'message' => 'success']);
            }
            return response()->json(['status' => 0, 'message' => 'fail']);
        }
        return response()->json(['status' => 0, 'message' => 'error']);
    }

    public function departmentList(Request $request)
    {
        $val = $request->get('q');
        return app(RepositoriesDepartment::class)->getApiList($val);
        
    }
}
