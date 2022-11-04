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

use App\Admin\Metrics\Center;
use App\Admin\Renderables\Center as RenderablesCenter;
use App\Http\Controllers\Controller;
use Dcat\Admin\Controllers\Dashboard;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        // return $content
        //     ->header('数据统计')
        //     ->description('大数据中心')
        //     ->body(function(Row $row){
        //         $row->column(12 , '<h4>基础数据</h4><hr>');
        //         $row->column(4 , new Center\TotalUsers());
        //         $row->column(4 , new Center\TotalUsers());
        //         $row->column(4 , new Center\TotalUsers());
        //         $row->column(12 , new RenderablesCenter());



        //         $row->column(12 , '<h4>进货报表</h4><hr>');


        //     });

        return $content
            ->header('数据统计')
            ->description('大数据中心')
            ->body(function (Row $row) {
                $row->column(6, function (Column $column) {
                    $column->row(function (Row $row) {
                        $row->column(6, new Center\NewUsers());
                        $row->column(6, new Center\NewDevices());
                    });
                    //    $column->row(Dashboard::title());
                    $column->row(new Center\Tickets());
                    $column->row(new Center\TotalUsers());
                });

                $row->column(6, function (Column $column) {


                    $column->row(new Center\Sessions());
                    $column->row(new Center\ProductOrders());
                    $column->row(new Center\GoalOverview());
                });
            });
    }

    public function test()
    {
        cache()->set('yytest', 'hehe');
    }
}
