<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\FlowStep;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class FlowStepController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new FlowStep(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('approval_id');
            $grid->column('flow_uid');
            $grid->column('sort');
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
        return Show::make($id, new FlowStep(), function (Show $show) {
            $show->field('id');
            $show->field('approval_id');
            $show->field('flow_uid');
            $show->field('sort');
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
        return Form::make(new FlowStep(), function (Form $form) {
            $form->display('id');
            $form->text('approval_id');
            $form->text('flow_uid');
            $form->text('sort');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
