<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\ContractTradePrint;
use App\Admin\Actions\Grid\SettleData;
use App\Admin\Renderables\FrameContractTable;
use App\Admin\Renderables\PurchaseOrderTable;
use App\Admin\Renderables\SaleOrderTable;
use App\Admin\Repositories\Customer;
use App\Admin\Repositories\FrameContract;
use App\Models\CustomerModel;
use App\Models\Template;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Form\NestedForm;
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
            $grid->column('purchase_order', '采购合同列表')->display('查看')->modal(PurchaseOrderTable::make());
            $grid->column('sale_order', '销售合同列表')->display('查看')->modal(SaleOrderTable::make());
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
            $grid->actions(new ContractTradePrint());

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->equal('sn');
                $filter->equal('customer_id')->select(app(Customer::class)->selectItems());
                
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
            $form->tab('信息设置' ,function(Form $form){
                $form->display('id');
                $form->text('sn')->value(create_uniqid_sn('frame_contract'))->readonly()->required();
                $form->decimal('money')->readOnly();
                $form->select('customer_id')->options(app(Customer::class)->selectItems())->required();
                // $form->text('products');
                $form->decimal('year_rate');
                $form->decimal('zhanyong_rate', '资金占用费率(年化率)');
                $form->decimal('caozuo_rate', '操作费率');
                $form->select('template_id', '合作协议模板')->options(Template::where('type', 2)->pluck('title', 'id'))->required();
                $form->multipleImage('pics')->saving(function ($v) {
                    $v = Helper::array($v);
                    return json_encode($v);
                });
                $form->hidden('template_data');
            });
            if ($form->isEditing()) {
                $form->tab('协议模板参数设置' , function(Form $form){
                    $template = Template::find($form->model()->template_id);
                    foreach ($template->fields as $item) {
                        $form->textarea($item['field'], $item['name'])->customFormat(function ($i) use ($item) {
                            $template_data = json_decode($this->template_data, JSON_UNESCAPED_UNICODE);
                            return $template_data[$item['field']] ?? '';
                        });
                    }
                });
            }

            
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
            

            // $form->display('created_at');
            // $form->display('updated_at');

            if ($form->isCreating()) {
                $form->saved(function ($form) {
                    increment_uniqid_sn('frame_contract');
                });
            }
            if ($form->isEditing()) {
                $template = Template::find($form->model()->template_id);
                $template_data = [];
                foreach ($template->fields as $item) {
                    $template_data[$item['field']] = $form->input($item['field']);
                    $form->deleteInput($item['field']);
                }
                $form->template_data = json_encode($template_data);
                $form->deleteInput('check_user_ids');
            }
        });
    }
}
