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
use App\Admin\Repositories\Supplier;
use App\Models\SupplierModel;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Controllers\AdminController;

class SupplierController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Supplier(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('link')->emp();
            $grid->column('name')->emp();

            $grid->column('status')->using(SupplierModel::STATUS_LIST);
            $grid->column('phone')->emp();
            $grid->column('other')->emp();
            $grid->column('created_at');

            $grid->filter(function (Grid\Filter $filter) {
            });
        });
    }

    protected function iFrameGrid()
    {
        return Grid::make(new Supplier(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('link')->emp();
            $grid->column('name')->emp();

            $grid->column('pay_method')->using(SupplierModel::PAY_METHOD);
            $grid->column('phone')->emp();
            $grid->column('other')->emp();
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
        return Form::make(new Supplier(), function (Form $form) {
            $form->text('name')->required();
            $form->text('short_title')->required();
            $form->text('link')->required();
            $form->hidden('pay_method')->default(0);
            $form->text('phone')->rules('phone:CN,mobile')->required();
            $form->text('other')->saveAsString();
            $form->text('sn')->value(create_uniqid_sn('supplier'))->readonly()->required();
            $form->select('type')->options(SupplierModel::TYPE_LIST)->required();
            $form->select('status')->options(SupplierModel::STATUS_LIST)->required();
            $form->text('address')->required();
            $form->text('contact_department');
            $form->text('contact_tel')->required();
            $form->text('contact_email')->required();
            $form->text('bank_title')->required();
            $form->text('bank_name')->required();
            $form->text('bank_account')->required();
            $form->text('bank_top')->required();
        });
    }
}
