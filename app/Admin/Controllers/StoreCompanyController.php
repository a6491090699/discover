<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\StoreCompany;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class StoreCompanyController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new StoreCompany(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('address');
            $grid->column('charge_man');
            $grid->column('tel');
            $grid->column('tax_code');
            $grid->column('bank');
            $grid->column('bank_account');
            $grid->column('created_at');
            // $grid->column('updated_at')->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('title');
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
        return Show::make($id, new StoreCompany(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('address');
            $show->field('charge_man');
            $show->field('tel');
            $show->field('tax_code');
            $show->field('bank');
            $show->field('bank_account');
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
        return Form::make(new StoreCompany(), function (Form $form) {
            $form->display('id');
            $form->text('title')->required();
            $form->text('short_title')->required();
            $form->text('address')->required();
            $form->text('charge_man')->required();
            $form->text('tel')->required();
            $form->text('tax_code')->required();
            $form->text('bank')->required();
            $form->text('bank_account')->required();
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
