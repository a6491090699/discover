<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Invoice;
use App\Admin\Repositories\SellPayLog;
use App\Models\AdminUser;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class InvoiceController extends AdminController
{
    
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Invoice(['paylog.customer', 'paylog.saleOrder', 'user']), function (Grid $grid) {
            
            $grid->column('id')->sortable();
            $grid->column('sn', '开票编号');
            $grid->column('invoice_no', '发票号码');
            $grid->column('user.name', '申请人');
            $grid->column('paylog.customer.name', '关联客户');
            $grid->column('paylog.saleOrder.order_no', '关联合同');
            $grid->column('paylog.sn', '关联回款编号');
            $grid->column('paylog.this_time_money', '回款金额');
            $grid->column('invoice_at', '申请时间');
            $grid->column('money', '开票金额');
            $grid->column('type', '开票类型');
            // $grid->column('other','备注');
            $grid->column('created_at', '创建时间');
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
        return Show::make($id, new Invoice(), function (Show $show) {
            $show->field('id');
            $show->field('paylog_type');
            $show->field('paylog_id');
            $show->field('sn');
            $show->field('invoice_no');
            $show->field('user_id');
            $show->field('invoice_at');
            $show->field('money');
            $show->field('type');
            $show->field('other');
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
        return Form::make(new Invoice(), function (Form $form) {
            $form->display('id');
            $form->text('sn', '开票编号')->default(create_uniqid_sn('FP'));
            $form->text('invoice_no', '发票号码')->required();
            $form->select('user_id', '申请人')->options(AdminUser::pluck('name', 'id')->toarray());
            $form->select('sell_pay_log_id', '关联回款')->options(app(SellPayLog::class)->selectItems());
            $form->datetime('invoice_at', '开票时间');
            $form->decimal('money', '开票金额');
            $form->select('type', '开票类型')->options(['类型1', '类型2'])->required();
            $form->text('other', '备注');

            if ($form->isCreating()) {
                $form->saved(function ($form) {
                    increment_uniqid_sn('FP');
                });
            }
        });
    }
}
