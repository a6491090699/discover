<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Delivery;
use App\Models\Delivery as ModelsDelivery;
use App\Models\PurchaseOrderModel;
use App\Models\SaleOutOrderModel;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class DeliveryController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Delivery(), function (Grid $grid) {
            $grid->column('id')->sortable();
            // $grid->column('order_id');
            // $grid->column('order_type');
            $grid->column('sn');
            $grid->column('send_at');
            $grid->column('arrived_at');
            $grid->column('status');
            $grid->column('money');
            // $grid->column('enclosure');
            $grid->column('created_at');
            // $grid->column('updated_at')->sortable();

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
        return Show::make($id, new Delivery(), function (Show $show) {
            $show->field('id');
            $show->field('order_id');
            $show->field('order_type');
            $show->field('sn');
            $show->field('send_at');
            $show->field('arrived_at');
            $show->field('status');
            $show->field('money');
            $show->field('enclosure');
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
        return Form::make(new Delivery(), function (Form $form) {
            $form->display('id');
            $form->hidden('order_id');
            $form->select('order_type')->options([
                'purchase_order' => '采购合同',
                'sale_out_order' => '销售合同',
            ])->when('purchase_order', function ($form) {
                $form->select('order_id_list1', '关联合同号')->options(PurchaseOrderModel::pluck('order_no', 'id'));
            })->when('sale_out_order', function ($form) {
                $form->select('order_id_list2', '关联合同号')->options(SaleOutOrderModel::pluck('order_no', 'id'));
            });
            $form->text('sn');
            $form->text('company', '物流公司');
            $form->datetime('send_at');
            $form->datetime('arrived_at');
            $form->select('status')->options(ModelsDelivery::STATUS_LIST);
            $form->decimal('money');
            $form->file('enclosure');
            $form->saving(function ($form) {
                $form->order_id = $form->order_id_list1 ? $form->order_id_list1 : $form->order_id_list2;
                $form->deleteInput('order_id_list1'); 
                $form->deleteInput('order_id_list2'); 
            });

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
