<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Customer;
use App\Admin\Repositories\FeeType as RepositoriesFeeType;
use App\Admin\Repositories\SaleOrder;
use App\Admin\Repositories\SellPayLog;
use App\Models\SellPayLog as ModelsSellPayLog;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class SellPayLogController extends AdminController
{
    public function title()
    {
        return '销售单回款记录';
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new SellPayLog(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('sn');
            $grid->column('sale_order_id')->using(app(SaleOrder::class)->selectItems());
            $grid->column('fee_type_id', '费用类型')->using(app(RepositoriesFeeType::class)->selectItems());
            $grid->column('pay_at');
            $grid->column('customer_id')->using(app(Customer::class)->selectItems());
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
            $form->select('fee_type_id', '费用类型')->options(app(RepositoriesFeeType::class)->selectItems());
            $form->select('sale_order_id')->options(app(SaleOrder::class)->selectItems());
            $form->text('sn')->default(build_order_no('BPL'));
            $form->datetime('pay_at');
            // $form->datetime('check_at','核算时间');
            $form->select('customer_id')->options(app(Customer::class)->selectItems());
            // $form->decimal('contract_money');
            // $form->decimal('unpay_money');
            $form->decimal('this_time_money');
            $form->select('pay_method')->options(ModelsSellPayLog::PAY_METHOD_LIST);
            $form->file('enclosure');
            $form->text('other');

            $form->display('created_at');
            $form->display('updated_at');

            $form->saved(function ($form) {
                //计算费用
                app(SaleOrder::class)->calculateFee($form->model());
            });
        });
    }
}
