<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\FlowRecord;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class FlowRecordController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new FlowRecord(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('approval_id');
            $grid->column('step_id');
            $grid->column('check_user_id');
            $grid->column('content');
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
        return Show::make($id, new FlowRecord(), function (Show $show) {
            $show->field('id');
            $show->field('approval_id');
            $show->field('step_id');
            $show->field('check_user_id');
            $show->field('content');
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
        return Form::make(new FlowRecord(), function (Form $form) {
            $form->display('id');
            $form->text('approval_id');
            $form->text('step_id');
            $form->text('check_user_id');
            $form->text('content');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
