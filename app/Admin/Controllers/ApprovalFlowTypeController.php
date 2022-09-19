<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\ApprovalFlowType;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class ApprovalFlowTypeController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new ApprovalFlowType(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('approval_type_id');
            $grid->column('desc');
            $grid->column('check_users');
            $grid->column('status');
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
        return Show::make($id, new ApprovalFlowType(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('approval_type_id');
            $show->field('desc');
            $show->field('check_users');
            $show->field('status');
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
        return Form::make(new ApprovalFlowType(), function (Form $form) {
            $form->display('id');
            $form->text('title');
            $form->text('approval_type_id');
            $form->text('desc');
            $form->text('check_users');
            $form->text('status');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
