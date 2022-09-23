<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\SettleData;
use App\Admin\Renderables\FrameContractTable;
use App\Admin\Renderables\PurchaseOrderTable;
use App\Admin\Renderables\SaleOrderTable;
use App\Admin\Repositories\Customer;
use App\Admin\Repositories\FrameContract;
use App\Models\CustomerModel;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Support\Helper;

class FrameContractController extends AdminController
{
    public function title()
    {
        return '框架合同列表';
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new FrameContract(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('sn');
            $grid->column('money');
            $grid->column('customer_id')->using(app(Customer::class)->selectItems());
            $grid->column('purchase_order' ,'采购合同列表')->display('查看')->modal(PurchaseOrderTable::make());
            $grid->column('sale_order' ,'销售合同列表')->display('查看')->modal(SaleOrderTable::make());
            // $grid->column('products');
            // $grid->column('year_rate');
            // $grid->column('money_zy');
            // $grid->column('money_czf');
            // $grid->column('money_wlf');
            // $grid->column('money_ccf');
            // $grid->column('money_yhsxf');
            // $grid->column('money_jkgs');
            // $grid->column('money_zzs');
            // $grid->column('money_sc');
            // $grid->column('money_other');
            // $grid->column('status');
            // $grid->column('pics');
            $grid->column('created_at');
            $grid->actions(new SettleData());
        
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
        return Show::make($id, new FrameContract(), function (Show $show) {
            $show->field('id');
            $show->field('sn');
            $show->field('money');
            $show->field('customer_id');
            $show->field('products');
            $show->field('year_rate');
            // $show->field('money_zy');
            // $show->field('money_czf');
            // $show->field('money_wlf');
            // $show->field('money_ccf');
            // $show->field('money_yhsxf');
            // $show->field('money_jkgs');
            // $show->field('money_zzs');
            // $show->field('money_sc');
            // $show->field('money_other');
            // $show->field('status');
            $show->field('pics');
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
        return Form::make(new FrameContract(), function (Form $form) {
            $form->display('id');
            $form->text('sn')->value(create_uniqid_sn('frame_contract'))->readonly()->required();
            $form->decimal('money')->readOnly();
            $form->select('customer_id')->options(app(Customer::class)->selectItems())->required();
            // $form->text('products');
            $form->decimal('year_rate');
            $form->decimal('zhanyong_rate' ,'资金占用费率(年化率)');
            $form->decimal('caozuo_rate','操作费率');
            // $form->selectTable('purcharse_order_ids')->title('采购合同关联(多选)')->dialogWidth('50%')->from()->model();
            // $form->selectTable('sale_order_ids')->title('销售合同关联(多选)')->dialogWidth('50%')->from()->model();
            // $form->decimal('money_zy');
            // $form->decimal('money_czf');
            // $form->decimal('money_wlf');
            // $form->decimal('money_ccf');
            // $form->decimal('money_yhsxf');
            // $form->decimal('money_jkgs');
            // $form->decimal('money_zzs');
            // $form->decimal('money_sc');
            // $form->keyValue('money_other');
            // $form->number('status')->required();
            $form->multipleImage('pics')->saving(function ($v) {
                $v = Helper::array($v);
                return json_encode($v);
            });
            
            // $form->display('created_at');
            // $form->display('updated_at');

            $form->saved(function($form){
                increment_uniqid_sn('frame_contract');
            });

        });
    }
}
