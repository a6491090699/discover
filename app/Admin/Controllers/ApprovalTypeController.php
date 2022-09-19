<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\ApprovalType;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class ApprovalTypeController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new ApprovalType(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('status');
            $grid->column('order');
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
        return Show::make($id, new ApprovalType(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('status');
            $show->field('order');
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
        return Form::make(new ApprovalType(), function (Form $form) {
            $form->display('id');
            $form->text('title');
            $form->text('status');
            $form->text('order');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
