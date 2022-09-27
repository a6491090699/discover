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

use App\Admin\Actions\Grid\Statement;
use App\Admin\Repositories\Customer;
use App\Models\AdminUser;
use App\Models\CustomerModel;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Controllers\AdminController;

class CustomerController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Customer(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('link')->emp();
            $grid->column('name')->emp();
            $grid->column('other')->emp();
            $grid->column('status')->using(CustomerModel::STATUS_LIST);
            $grid->column('phone');
            $grid->column('created_at');
            $grid->filter(function (Grid\Filter $filter) {
            });
        });
    }

    protected function iFrameGrid()
    {
        return Grid::make(new Customer(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('link')->emp();
            $grid->column('name')->emp();
            $grid->column('other')->emp();
            $grid->column('pay_method')->using(CustomerModel::PAY);
            $grid->column('phone');
            $grid->column('created_at');
            $grid->tools(Statement::make());
            $grid->disableCreateButton();
            $grid->disableActions();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Customer(), function (Form $form) {
            
            $form->text('name')->required();
            $form->text('short_title')->required();
            $form->text('link')->required();
            $form->text('other')->required();
            // $form->select('pay_method')->options(CustomerModel::PAY)->default(0)->required();
            $form->mobile('phone')->required();

            // $form->multipleSelect('drawee', '付款人')->options($form->repository()->drawee())->customFormat(function (array $v) {
            //     return array_column($v, 'id');
            // });
    //             $form->hasMany('address', '客户地址', function (Form\NestedForm $form) {
    //                 $form->text('address', '地址')->required();
    // //                $form->text('other')->default('')->saveAsString();
    //             })->useTable();

            $form->text('sn')->value(create_uniqid_sn('customer'))->readonly()->required();
            $form->select('status')->options(CustomerModel::STATUS_LIST)->required();

            $form->text('address')->required();
            $form->select('user_id')->options(AdminUser::pluck('name','id'));
            // $form->text('department')->required();
            $form->datetime('sign_start_at')->required();
            $form->datetime('sign_stop_at')->required();
            $form->decimal('money_limit')->required();
            $form->text('contact_department');
            $form->text('contact_tel')->required();
            $form->text('contact_email')->required();
            $form->text('contact_qq')->required();
            $form->text('bank_title')->required();
            $form->text('bank_name')->required();
            $form->text('bank_account')->required();
            $form->text('bank_top')->required();
            $form->text('tax_code')->required();
            if ($form->isCreating()) {
                $form->saved(function ($form) {
                    increment_uniqid_sn('customer');
                });
            }
        });
    }
}
