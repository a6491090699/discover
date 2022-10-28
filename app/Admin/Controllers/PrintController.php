<?php

/*
 * // +----------------------------------------------------------------------
 * // | erp
 * // +----------------------------------------------------------------------
 * // | Copyright (c) 2006~2020 erp All rights reserved.
 * // +----------------------------------------------------------------------
 * // | Licensed ( LICENSE-1.0.0 )
 * // +----------------------------------------------------------------------
 * // | Author: yxx <1365831278@qq.com>
 * // +----------------------------------------------------------------------
 */

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Approval;
use App\Models\FrameContract;
use App\Models\PurchaseOrderModel;
use App\Models\SaleOrderModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PrintController extends Controller
{
    public function print(Request $request)
    {
        $orderIds = explode("-", $request->input('ids'));
        $model = $request->input('model');
        /** @var Model $modelClass */
        $modelClass = "\\App\Models\\" . $model;
        $orders = $modelClass::query()->findOrFail($orderIds);
        $orderSlug = $request->input('slug');
        $orderField = collect(admin_trans($orderSlug . ".fields"))->chunk(2)->toArray();

        $itemSlug = Str::replaceFirst("order", "item", $orderSlug);
        $itemField = admin_trans($itemSlug . ".fields");
        $orderName = head(admin_trans($orderSlug . ".labels"));
        return view('print.print', compact("orders", 'orderField', 'itemField', 'orderName'));
    }

    public function approvalPrint($id, Request $request)
    {
        $approval = Approval::find($id);
        if ($template_slug = $approval->flow->template->slug) {
            $dir = 'print.approval';
            $temp = $dir . '.' . $template_slug;
            $param  = json_decode($approval->content, true);
            // dd($param , $temp);
            return view($temp, compact('param'));
        }
        abort(404);
        // $orderIds = explode("-", $request->input('ids'));
        // $model = $request->input('model');
        // /** @var Model $modelClass */
        // $modelClass = "\\App\Models\\" . $model;
        // $orders = $modelClass::query()->findOrFail($orderIds);
        // $orderSlug = $request->input('slug');
        // $orderField = collect(admin_trans($orderSlug.".fields"))->chunk(2)->toArray();

        // $itemSlug = Str::replaceFirst("order", "item", $orderSlug);
        // $itemField = admin_trans($itemSlug.".fields");
        // $orderName = head(admin_trans($orderSlug . ".labels"));
        // return view('print.print', compact("orders", 'orderField', 'itemField', 'orderName'));

        // return view('print.approval.ckhq');
    }

    public function test()
    {
        $template_slug = request()->input('t');
        $dir = 'print';
        $temp = $dir . '.' . $template_slug;
        return view($temp);
    }

    public function contractPrint($id, Request $request)
    {
        $type = $request->input('type');
        $dir = 'print.contract';
        switch ($type) {
            case 'buy':
                $info = PurchaseOrderModel::find($id);
                $temp = $dir . '.buy';
                break;
            case 'sell':
                $info = SaleOrderModel::find($id);
                $temp = $dir . '.sell';
                break;
            // case 'import':
            //     $info = FrameContract::find($id);
            //     $temp = $dir . '.import';
            //     break;
            // case 'domestic_trade':
            //     $info = FrameContract::find($id);
            //     $temp = $dir . '.domestic_trade';
            //     break;
            case 'trade':
                $info = FrameContract::find($id);
                $info->template_data = json_decode($info->template_data, true);
                $temp = $dir . '.' . $request->input('slug');
                break;
        }
        //yytodo 修改sale_order表  字段跟最近的purchase_order表类似 看笔记        
        if ($temp) {
            return view($temp, compact('info'));
        }
        abort(404);
    }
}
