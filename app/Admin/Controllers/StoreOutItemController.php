<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\StoreOutItem;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class StoreOutItemController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new StoreOutItem(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('store_out_id');
            $grid->column('sku_id');
            $grid->column('should_num');
            $grid->column('actual_num');
            $grid->column('price');
            $grid->column('sum_price');
            $grid->column('product_id');
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
        return Show::make($id, new StoreOutItem(), function (Show $show) {
            $show->field('id');
            $show->field('store_out_id');
            $show->field('sku_id');
            $show->field('should_num');
            $show->field('actual_num');
            $show->field('price');
            $show->field('sum_price');
            $show->field('product_id');
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
        return Form::make(new StoreOutItem(), function (Form $form) {
            $form->display('id');
            $form->text('store_out_id');
            $form->text('sku_id');
            $form->text('should_num');
            $form->text('actual_num');
            $form->text('price');
            $form->text('sum_price');
            $form->text('product_id');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
