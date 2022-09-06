<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\AllocationItem;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class AllocationItemController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new AllocationItem(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('allocation_id');
            $grid->column('sku_id');
            $grid->column('product_id');
            $grid->column('num');
            $grid->column('price');
            $grid->column('sum_price');
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
        return Show::make($id, new AllocationItem(), function (Show $show) {
            $show->field('id');
            $show->field('allocation_id');
            $show->field('sku_id');
            $show->field('product_id');
            $show->field('num');
            $show->field('price');
            $show->field('sum_price');
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
        return Form::make(new AllocationItem(), function (Form $form) {
            $form->display('id');
            $form->text('allocation_id');
            $form->text('sku_id');
            $form->text('product_id');
            $form->text('num');
            $form->text('price');
            $form->text('sum_price');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
