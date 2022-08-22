<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Company;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class CompanyController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Company(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('hostname');
            $grid->column('tel');
            $grid->column('tax_number');
            $grid->column('bank');
            $grid->column('bank_count');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
        
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
        return Show::make($id, new Company(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('hostname');
            $show->field('tel');
            $show->field('tax_number');
            $show->field('bank');
            $show->field('bank_count');
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
        return Form::make(new Company(), function (Form $form) {
            $form->display('id');
            $form->text('title');
            $form->text('hostname');
            $form->text('tel');
            $form->text('tax_number');
            $form->text('bank');
            $form->text('bank_count');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
