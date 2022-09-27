<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\BuyPayLog;
use App\Admin\Repositories\FeeType;
use App\Admin\Repositories\PurchaseOrder;
use App\Admin\Repositories\Supplier;
use App\Models\BuyPayLog as ModelsBuyPayLog;
use App\Models\PurchaseOrderModel;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class BuyPayLogController extends AdminController
{
    public function title()
    {
        return '采购单付款记录';
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new BuyPayLog(['purchaseOrder.supplier']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('sn');
            $grid->column('fee_type_id', '费用类型')->using(app(FeeType::class)->selectItems());
            $grid->column('purchase_order_id')->using(app(PurchaseOrder::class)->selectItems());

            $grid->column('pay_at');
            $grid->column('purchaseOrder.supplier.name','供应商');
            $grid->column('this_time_money');
            $grid->column('purchaseOrder.total_money', '合同金额');
            $grid->column('unpay_money');

            $grid->column('created_at');
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableDelete(false);
            });
            
            $grid->showBatchDelete();

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
        return Show::make($id, new BuyPayLog(), function (Show $show) {
            $show->field('id');
            $show->field('sn');
            $show->field('pay_at');
            $show->field('supplier_id');
            $show->field('fee_type_id');
            $show->field('contract_money');
            $show->field('unpay_money');
            $show->field('this_time_money');
            $show->field('pay_method');
            $show->field('purchase_order_id');
            $show->field('other');
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
        return Form::make(new BuyPayLog(), function (Form $form) {
            $form->display('id');
            $form->text('sn')->default(create_uniqid_sn('BPL'));
            $form->select('purchase_order_id')->options(app(PurchaseOrder::class)->selectItems())->required();

            $form->datetime('pay_at');
            // $form->select('supplier_id')->options(app(Supplier::class)->selectItems());
            $form->select('fee_type_id', '费用类型')->options(app(FeeType::class)->selectItems());
            // $form->text('contract_money');
            $form->text('unpay_money')->help('留空则自动计算');
            $form->text('this_time_money');
            $form->select('pay_method')->options(ModelsBuyPayLog::PAY_METHOD_LIST);

            $form->text('other');
            if ($form->isEditing()) {
            }
            if ($form->isCreating()) {
                $form->saving(function ($form) {
                    if (empty($form->unpay_money)) {
                        $order = PurchaseOrderModel::find($form->purchase_order_id);
                        //货款类型
                        $sofar_money = $order->payLog()->where('fee_type_id',1)->sum('this_time_money') + $form->this_time_money;
                        $form->unpay_money = max($order->total_money - $sofar_money, 0);
                    }
                });
                $form->saved(function ($form) {
                    increment_uniqid_sn('BPL');
                });
            }

            
        });
    }
}
