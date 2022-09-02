<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\PurchaseBackItem;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class PurchaseBackItemController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new PurchaseBackItem(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('purchase_order_back_id');
            $grid->column('sku_id');
            $grid->column('back_num');
            $grid->column('price');
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
        return Show::make($id, new PurchaseBackItem(), function (Show $show) {
            $show->field('id');
            $show->field('purchase_order_back_id');
            $show->field('sku_id');
            $show->field('back_num');
            $show->field('price');
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
        return Form::make(new PurchaseBackItem(), function (Form $form) {
            $form->display('id');
            $form->text('purchase_order_back_id');
            $form->text('sku_id');
            $form->text('back_num');
            $form->text('price');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
