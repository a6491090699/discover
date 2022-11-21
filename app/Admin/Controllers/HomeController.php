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
use App\Models\Department;
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
            ->body(function (Row $row) {
                // $row->column(12 , '<h4>基础数据</h4><hr>');
                $row->column(12, new Basic());
                $row->column(12, new Purchase());
                $row->column(12, new Sale());

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
        $list = Department::where('company_id', 2)->get()->toArray();
        $list = list_to_tree($list, 'id', 'parent_id', '_child');

        $ret = $this->loopSome($list);
        dd($list, $ret);
    }

    public function loopSome($list, $level=0)
    {
        static $ret = [];

        foreach ($list as $item) {
            $ret[] = [
                'id' => $item['id'],
                'text' => str_repeat('-', $level) . $item['title'],
            ];
            if (isset($item['_child'])) {
                $n = $level+1;
                $this->loopSome($item['_child'], $n);
            }
        }

        return $ret;
    }
}
