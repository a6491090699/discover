<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Customer;
use App\Admin\Repositories\FeeType;
use App\Admin\Repositories\SaleOrder;
use App\Admin\Repositories\SellPayLog;
use App\Models\SellPayLog as ModelsSellPayLog;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class SellPayLogController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new SellPayLog(['saleOrder.customer']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('sn');
            $grid->column('sale_order_id')->using(app(SaleOrder::class)->selectItems());
            $grid->column('fee_type_id')->using(app(FeeType::class)->selectItems());
            $grid->column('pay_at');
            $grid->column('saleOrder.customer.name');
            // $grid->column('contract_money');
            // $grid->column('unpay_money');
            // $grid->column('this_time_money');
            // $grid->column('pay_method');
            // $grid->column('enclosure');
            // $grid->column('other');
            $grid->column('created_at');
            // $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->equal('sn');
                $filter->equal('fee_type_id')->select(app(FeeType::class)->selectItems());
                $filter->equal('sale_order_id')->select(app(SaleOrder::class)->selectItems());
                $filter->equal('saleOrder.customer_id','客户')->select(app(Customer::class)->selectItems());
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new SellPayLog(), function (Show $show) {
            $show->field('id');
            $show->field('sn');
            $show->field('pay_at');
            $show->field('check_at', '核算时间');
            $show->field('customer_id');
            $show->field('contract_money');
            $show->field('unpay_money');
            $show->field('this_time_money');
            $show->field('pay_method');
            $show->field('enclosure');
            $show->field('other');
            $show->field('sale_order_id');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new SellPayLog(), function (Form $form) {
            $form->display('id');
            $form->select('fee_type_id', '费用类型')->options(app(FeeType::class)->selectItems())->required();
            $form->select('sale_order_id')->options(app(SaleOrder::class)->selectItems())->required();
            $form->text('sn')->default(create_uniqid_sn('BPL'))->required();
            $form->datetime('pay_at')->required();
            // $form->datetime('check_at','核算时间');
            // $form->select('customer_id')->options(app(Customer::class)->selectItems());
            // $form->decimal('contract_money');
            // $form->decimal('unpay_money');
            $form->decimal('this_time_money')->required();
            $form->select('pay_method')->options(ModelsSellPayLog::PAY_METHOD_LIST)->required();
            $form->file('enclosure');
            $form->text('other');

            $form->display('created_at');
            $form->display('updated_at');

            $form->saved(function ($form) {
                //计算费用
                $updates = $form->updates();
                increment_uniqid_sn('BPL');
                // app(SaleOrder::class)->calculateFee($updates);
            });
        });
    }
}
