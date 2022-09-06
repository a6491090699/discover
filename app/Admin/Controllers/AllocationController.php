<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Allocation;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class AllocationController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Allocation(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('sn');
            $grid->column('trans_at');
            $grid->column('out_store_id');
            $grid->column('in_store_id');
            $grid->column('total_money');
            $grid->column('charge_man');
            $grid->column('mark');
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
        return Show::make($id, new Allocation(), function (Show $show) {
            $show->field('id');
            $show->field('sn');
            $show->field('trans_at');
            $show->field('out_store_id');
            $show->field('in_store_id');
            $show->field('total_money');
            $show->field('charge_man');
            $show->field('mark');
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
        return Form::make(new Allocation(), function (Form $form) {
            $form->display('id');
            $form->text('sn');
            $form->text('trans_at');
            $form->text('out_store_id');
            $form->text('in_store_id');
            $form->text('total_money');
            $form->text('charge_man');
            $form->text('mark');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
