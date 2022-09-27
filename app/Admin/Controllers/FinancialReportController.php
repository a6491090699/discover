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

use App\Admin\Repositories\CostOrder;
use App\Admin\Repositories\FrameContract as RepositoriesFrameContract;
use App\Admin\Repositories\PurchaseOrder;
use App\Admin\Repositories\StatementItem;
use App\Exports\SettleExport;
use App\Models\CostOrderModel;
use App\Models\CustomerModel;
use App\Models\FrameContract;
use App\Models\StatementOrderModel;
use App\Models\SupplierModel;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Excel;

class FinancialReportController extends AdminController
{
    public function settlementHistory(Content $content)
    {
        $grid = Grid::make(new StatementItem(['cost_order', 'order']), function (Grid $grid) {
            $grid->model()->resetOrderBy();
            $grid->model()->whereHas('order', function (Builder $builder) {
                $builder->where('review_status', StatementOrderModel::REVIEW_STATUS_OK);
            })->orderByDesc('id')->orderByDesc('statement_order_id');
            $grid->column('cost_order.order_no', '费用单号')->sortable();
            $grid->column('order.order_no', '结算单号')->sortable();
            $grid->column('order.company_name', '公司名称');
            $grid->column('order.category_str', '费用分类');
            $grid->column('should_amount', '期初应付')->sortable();
            $grid->column('actual_amount', '本期发生额')->sortable();
            $grid->column('discount_amount', '本期优惠金额')->sortable();
            $grid->column('remaining_sum', '结余应付');
            $grid->column('order.other', '备注')->emp();
            $grid->column('order.updated_at', '操作日期');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->between('order.updated_at', "时间")->datetime()->width(6)->default([
                    'start' => now()->subMonth(),
                    'end' => now()
                ]);
                $filter->equal('order.category', '费用分类')->width(3)->radio(CostOrderModel::CATEGORY);
                $filter->like('cost_order.order_no', '费用单号')->width(3);
                $filter->like('order.order_no', '结算单号')->width(3);
                if (request()->exists('order.category') && request('order.category') == StatementOrderModel::CATEGORY_CUSTOMER) {
                    $filter->equal('order.company_id', "客户名称")->width(3)->select(CustomerModel::query()->latest()->pluck('name', 'id'));
                }
                if (request()->exists('order.category') && request('order.category') == StatementOrderModel::CATEGORY_SUPPLIER) {
                    $filter->equal('order.company_id', "供应商名称")->width(3)->select(SupplierModel::query()->latest()->pluck('name', 'id'));
                }
            });
            $grid->export()->rows(function (array $rows) {
                return array_map(function ($row) {
                    return [
                        '费用单号' => $row['cost_order']['order_no'],
                        '结算单号' => $row['order']['order_no'],
                        '公司名称' => $row['order']['company_name'],
                        '费用分类' => $row['order']['category_str'],
                        '期初应付' => $row['should_amount'],
                        '本期发生额' => $row['actual_amount'],
                        '本期优惠金额' => $row['discount_amount'],
                        '结余应付' => $row['remaining_sum'],
                        '备注' => $row['order']['other'],
                        '操作日期' => $row['order']['updated_at'],
                    ];
                }, $rows);
            })->extension("xlsx");
        });
        $grid->disableCreateButton();
        $grid->disableActions();
        return $content
            ->title("结算往来帐")
            ->description(' ')
            ->full()
            ->body($grid);
    }

    public function costOrderStatistical(Content $content)
    {
        $yearMonth = (new CostOrder())->getYearMonth();
        $grid = Grid::make(new CostOrder(), function (Grid $grid) use ($yearMonth) {
            $grid->model()->resetOrderBy();
            $grid->model()->where('review_status', CostOrderModel::REVIEW_STATUS_OK);
            $grid->column("accountant_item.year_month", "费用月份")->emp();
            $grid->column('category', "费用分类")->using(CostOrderModel::CATEGORY);
            $grid->column('company_str', "公司名称");
            $grid->column('total_amount', "费用总金额")->sortable();
            $grid->column('settlement_amount', '已付款金额')->sortable();
            $grid->column('discount_amount', '已优惠金额')->sortable();
            $grid->column('created_at')->sortable();
            $grid->disableActions();
            $grid->disableCreateButton();

            $grid->filter(function (Grid\Filter $filter) use ($yearMonth) {
                $filter->between('created_at', "时间")->datetime()->width(6)->default([
                    'start' => now()->subMonth(),
                    'end' => now()
                ]);
                $filter->equal('category', '费用分类')->width(3)->radio(CostOrderModel::CATEGORY);
                $filter->equal('accountant_item_id', "费用月份")->width(3)->select($yearMonth);

                if (request()->exists('category') && request('category') == StatementOrderModel::CATEGORY_CUSTOMER) {
                    $filter->equal('company_id', "客户名称")->width(3)->select(CustomerModel::query()->latest()->pluck('name', 'id'));
                }
                if (request()->exists('category') && request('category') == StatementOrderModel::CATEGORY_SUPPLIER) {
                    $filter->equal('company_id', "供应商名称")->width(3)->select(SupplierModel::query()->latest()->pluck('name', 'id'));
                }
            });

            $grid->export()->rows(function (array $rows) {
                return array_map(function ($row) {
                    return [
                        '费用月份' => $row['accountant_item']['year_month'],
                        '费用分类' => CostOrderModel::CATEGORY[$row['category']],
                        '公司名称' => $row['company_name'],
                        '费用总金额' => $row['total_amount'],
                        '已付款金额' => $row['settlement_amount'],
                        '已优惠金额' => $row['discount_amount'],
                        '创建时间' => $row['created_at'],
                    ];
                }, $rows);
            })->extension("xlsx");
        });
        return $content
            ->title("费用汇总")
            ->description(' ')
            ->full()
            ->body($grid);
    }

    public function unsettledCost(Content $content)
    {
        $yearMonth = (new CostOrder())->getYearMonth();
        $grid = Grid::make(new CostOrder(), function (Grid $grid) use ($yearMonth) {
            $grid->model()->resetOrderBy();
            $grid->model()->select([
                'company_id',
                'accountant_item_id',
                'category',
                DB::raw('sum(total_amount) - sum(settlement_amount) - sum(discount_amount) as sum_unsettled_amount'),
            ])->where('review_status', CostOrderModel::REVIEW_STATUS_OK)
                ->groupBy('company_id', 'category', 'accountant_item_id')
                ->having('sum_unsettled_amount', '>', 0);
            $grid->column('company_str', "公司名称");
            $grid->column('category_str', "费用分类");
            $grid->column("accountant_item.year_month", "费用月份")->emp();
            $grid->column('sum_unsettled_amount', "未结算金额")->sortable();

            $grid->filter(function (Grid\Filter $filter) use ($yearMonth) {
                $filter->equal('category', '费用分类')->width(4)->radio(CostOrderModel::CATEGORY);
                $filter->equal('accountant_item_id', "费用月份")->width(4)->select($yearMonth);

                if (request()->exists('category') && request('category') == StatementOrderModel::CATEGORY_CUSTOMER) {
                    $filter->equal('company_id', "客户名称")->width(4)->select(CustomerModel::query()->latest()->pluck('name', 'id'));
                }
                if (request()->exists('category') && request('category') == StatementOrderModel::CATEGORY_SUPPLIER) {
                    $filter->equal('company_id', "供应商名称")->width(4)->select(SupplierModel::query()->latest()->pluck('name', 'id'));
                }
            });

            $grid->export()->rows(function (array $rows) {
                return array_map(function ($row) {
                    return [
                        '公司名称' => $row['company_str'],
                        '费用分类' => $row['category_str'],
                        '费用月份' => $row['accountant_item']['year_month'],
                        '未结算金额' => $row['sum_unsettled_amount']
                    ];
                }, $rows);
            })->extension("xlsx");
            $grid->disableActions();
            $grid->disableCreateButton();
        });
        return $content
            ->title("未结算费用报表")
            ->description(' ')
            ->full()
            ->body($grid);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id 框架合同id
     * @return void
     */
    public function settleData(Content $content, FrameContract $id)
    {
        // yytodo
        if (request()->query('_reset')) {
            app(RepositoriesFrameContract::class)->triggerCount($id);
            return response()->json(['status' => 1, 'message' => '重置成功']);
        }
        $settle = app(RepositoriesFrameContract::class)->settleDetail($id);
        $frame_contract = $id;
        $purchase_all = 0;
        $sale_zhanyong = 0;
        $sale_all = 0;
        foreach ($settle['purchase_settle_data'] as $item) {
            $item['pay_logs']->map(function ($i) use (&$purchase_all) {
                $purchase_all += ($i->zhanyong + $i->caozuo + $i->this_time_money);
            });
        }
        foreach ($settle['sale_settle_data'] as $item) {
            $item['pay_logs']->map(function ($i) use (&$sale_zhanyong, &$sale_all) {
                $sale_zhanyong += $i->zhanyong;
                $sale_all += $i->this_time_money;
            });
        }
        $diff = $sale_zhanyong;
        $ret = compact('settle', 'sale_zhanyong', 'sale_all', 'purchase_all', 'frame_contract');
        if (request()->query('_export')) {
            return Excel::download(new SettleExport($ret), '结算数据.xlsx');
        }
        return $content
            ->title("结算单")
            ->description(' ')
            ->full()
            ->body(view('settle.detail', $ret));
    }
}
