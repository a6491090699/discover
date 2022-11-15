<?php

/*
 * // +----------------------------------------------------------------------
 * // | erp
 * // +----------------------------------------------------------------------
 * // | Copyright (c) 2006~2020 erp All rights reserved.
 * // +----------------------------------------------------------------------
 * // | Licensed ( LICENSE-1.0.0 )
 * // +----------------------------------------------------------------------
 * // | Author: yy <649109069@qq.com>
 * // +----------------------------------------------------------------------
 */

namespace App\Admin\Controllers;

use App\Admin\Metrics\Center;
use App\Admin\Renderables\Center\Basic;
use App\Admin\Renderables\Center\Purchase;
use App\Admin\Renderables\Center\Sale;
use App\Http\Controllers\Controller;
use App\Models\SkuStockBatchModel;
use App\Models\StockHistoryModel;
use App\Models\Store;
use Dcat\Admin\Controllers\Dashboard;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->header('数据统计')
            ->description('大数据中心')
            ->body(function(Row $row){
                // $row->column(12 , '<h4>基础数据</h4><hr>');
                $row->column(12 , new Basic());
                $row->column(12 , new Purchase());
                $row->column(12 , new Sale());
                
                // $row->column(12 , '<h4>进货报表</h4><hr>');
                

            });

        // return $content
        //     ->header('数据统计')
        //     ->description('大数据中心')
        //     ->body(function (Row $row) {
        //         $row->column(6, function (Column $column) {
        //             $column->row(function (Row $row) {
        //                 $row->column(6, new Center\NewUsers());
        //                 $row->column(6, new Center\NewDevices());
        //             });
        //             //    $column->row(Dashboard::title());
        //             $column->row(new Center\Tickets());
        //             $column->row(new Center\TotalUsers());
        //         });

        //         $row->column(6, function (Column $column) {


        //             $column->row(new Center\Sessions());
        //             $column->row(new Center\ProductOrders());
        //             $column->row(new Center\GoalOverview());
        //         });
        //     });
    }

    public function test()
    {

        $pd = SkuStockBatchModel::query()->with('stockHistory')->whereHas('stockHistory', function ($query) {
            $query->where('flag', StockHistoryModel::INVENTORY);
        })->orderBy('id', 'desc')->get();
        $pd_store = $pd->groupBy('store_id');
        $pd_group = $pd->mapToGroups(function ($item, $key) {
            return [$item->stockHistory->batch_no => $item];
        })->toArray();
        $pd_order_no = $pd->pluck('batch_no')->toArray();
        $link_in_order_no = StockHistoryModel::whereIn('with_order_no', $pd_order_no)->pluck('batch_no')->toArray();

        //盘点单的数量  .. 有可能多张盘点单 
        $pd_num = 0;
        foreach ($pd_group as $item) {
            $pd_num += $item[0]['num'];
        }

        $out = SkuStockBatchModel::query()->whereHas('stockHistory', function ($query) {
            $query->where('flag', StockHistoryModel::OUT);
        })->get();
        // $out_num = $out->sum('num');
        $out_store = $out->groupBy('store_id');
        // dd($out_store->toArray() , data_get($out_store->toArray() , '1.*.num'));
        $in = SkuStockBatchModel::query()->whereHas('stockHistory', function ($query) {
            $query->where('flag', StockHistoryModel::IN);
        })->whereNotIn('batch_no', $link_in_order_no)->get();
        $in_store = $in->groupBy('store_id');

        // $in_num = $in->sum('num');
        // $num = $pd_num + $in_num + $out_num;
        // dd($pd->toArray(), $out->toArray(), $in->toArray() , $pd_group);
        // cache()->set('yytest', 'hehe');

        $store_list = Store::get(['title as name' ,'id']);
        // dd($store_list->toArray());
        $store_list->transform(function($item,$key)use($pd_store,$in_store,$out_store){
            $pd_num = 0;
            $in_num = 0;
            $out_num = 0;
            // dd($pd_store->toArray());
            $pd_group = $pd_store[$item->id]->mapToGroups(function ($item) {
                return [$item->stockHistory->batch_no => $item];
            })->toArray();
            foreach ($pd_group as $i) {
                $pd_num += $i[0]['num'];
            }

            $in_num = array_sum(data_get($in_store->toArray() , $item->id.'.*.num'));
            $out_num = array_sum(data_get($out_store->toArray() , $item->id.'.*.num'));
            $item->value = $in_num + $out_num + $pd_num;
            return $item;
        });

        return $store_list->toArray();

    }

    public function test1()
    {
        
    }
}
