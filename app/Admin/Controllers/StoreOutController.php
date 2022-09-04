<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\StoreOut;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class StoreOutController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new StoreOut(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('sn');
            $grid->column('out_at');
            $grid->column('store_id');
            $grid->column('type');
            $grid->column('order_id');
            $grid->column('order_type');
            $grid->column('status');
            $grid->column('total_money');
            $grid->column('car_number');
            $grid->column('delivery_id');
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
        return Show::make($id, new StoreOut(), function (Show $show) {
            $show->field('id');
            $show->field('sn');
            $show->field('out_at');
            $show->field('store_id');
            $show->field('type');
            $show->field('order_id');
            $show->field('order_type');
            $show->field('status');
            $show->field('total_money');
            $show->field('car_number');
            $show->field('delivery_id');
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
        return Form::make(new StoreOut(), function (Form $form) {
            $form->display('id');
            $form->text('sn');
            $form->text('out_at');
            $form->text('store_id');
            $form->text('type');
            $form->text('order_id');
            $form->text('order_type');
            $form->text('status');
            $form->text('total_money');
            $form->text('car_number');
            $form->text('delivery_id');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
