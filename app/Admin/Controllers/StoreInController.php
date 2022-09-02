<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\StoreIn;
use App\Models\Store;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class StoreInController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new StoreIn(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('sn');
            $grid->column('in_at');
            // $grid->column('store_id');
            // $grid->column('type');
            // $grid->column('total_money');
            // $grid->column('car_number');
            // $grid->column('delivery_id');
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
        return Show::make($id, new StoreIn(), function (Show $show) {
            $show->field('id');
            $show->field('sn');
            $show->field('in_at');
            $show->field('store_id');
            $show->field('type');
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
        return Form::make(new StoreIn(), function (Form $form) {
            $form->display('id');
            $form->text('sn');
            $form->datetime('in_at');
            $form->select('store_id')->options(Store::pluck('title','id'));
            $form->select('type');
            $form->select('order_id');
            $form->select('delivery_id');
            $form->select('status');
            $form->text('total_money');
            $form->text('car_number');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
