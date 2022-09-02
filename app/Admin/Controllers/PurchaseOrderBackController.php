<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\PurchaseBackItem;
use App\Admin\Repositories\PurchaseOrderBack;
use App\Models\ProductModel;
use App\Models\PurchaseOrderBack as ModelsPurchaseOrderBack;
use App\Models\PurchaseOrderModel;
use App\Models\Store;
use App\Models\SupplierModel;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Layout\Content;
use Illuminate\Support\Fluent;

class PurchaseOrderBackController extends AdminController
{
    public function title()
    {
        return '采购退货';
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new PurchaseOrderBack(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('sn');
            $grid->column('back_at');
            $grid->column('purchase_order_id');
            $grid->column('store_id');
            $grid->column('supplier_id');
            $grid->column('back_money');
            $grid->column('status')->using(['未发货','已发货']);
            // $grid->column('other');
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
        return Show::make($id, new PurchaseOrderBack(), function (Show $show) {
            $show->field('id');
            $show->field('sn');
            $show->field('back_at');
            $show->field('purchase_order_id');
            $show->field('store_id');
            $show->field('supplier_id');
            $show->field('back_money');
            // $show->field('other');
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
        return Form::make(new PurchaseOrderBack(), function (Form $form) {
            $form->display('id');
            $form->text('sn')->readOnly();
            $form->datetime('back_at');
            $form->select('purchase_order_id')->options(PurchaseOrderModel::receive()->pluck('order_no', 'id'));
            $form->select('store_id')->options(Store::pluck('title', 'id'));
            $form->select('supplier_id')->options(SupplierModel::pluck('name','id'));
            $form->select('status','状态')->options(['未发货','已发货']);
            $form->hidden('back_money')->default(0);
            
            $form->display('created_at');
            $form->display('updated_at');
            // $form->text('other');
            if($form->isCreating()){
                $form->hasMany('items', '', function (Form\NestedForm $table) {
                    $table->select('product_id', '名称')->options(ProductModel::pluck('name', 'id'))->loadpku(route('api.product.find'))->required();
                    $table->ipt('unit', '单位')->rem(3)->default('-')->disable();
                    $table->ipt('type', '类型')->rem(5)->default('-')->disable();
                    $table->select('sku_id', '属性选择')->options()->required();
                    // $table->tableDecimal('percent', '含绒量')->default(0);
                    // $table->select('standard', '检验标准')->options(PurchaseOrderModel::STANDARD)->default(0);
                    $table->num('back_num', '退货数量')->required();
                    $table->tableDecimal('price', '退货价格')->default(0.00)->required();
                })->useTable()->width(12)->enableHorizontal();
            }
            if($form->isEditing()){
                
            }
            $form->saving(function ($form) {
                $form->sn = create_uniqid_sn('purchase_back');
                
                if($form->items){
                    $back_money = 0;
                    foreach($form->items as $item){
                        $back_money += $item['price']*$item['back_num'];
                    }
                    $form->back_money = $back_money;
                }
                
            });

        });
    }

    public function edit($id, Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description()['edit'] ?? trans('admin.edit'))
            ->body($this->form()->edit($id))
            ->body($this->setItems($id));
    }

    protected function setItems($id)
    {
        return Grid::make(new PurchaseBackItem(['sku','product']) , function(Grid $grid)use($id){
            $grid->setName('items');
            $order = ModelsPurchaseOrderBack::find($id);
            $grid->model()->where('purchase_order_back_id',$id);
   
            $grid->column('product.name', '产品名称');
            $grid->column('product.unit.name', '单位');
            $grid->column('product.type_str', '类型');
            // $grid->column('sku_id', '属性')->if(function () use ($order) {
            //     return $order->status === ModelsPurchaseOrderBack::STATUS_SEND;
            // })->display(function () {
            //     return $this->sku['attr_value_ids_str'] ?? '';
            // })->else()->selectplus(function (Fluent $fluent) {
            //     // dd($fluent->sku);
            //     return $this->sku['attr_value_ids_str'] ?? '';
            // });
            $grid->column('back_num', '采购数量')->if(function () use ($order) {
                return $order->status !==  ModelsPurchaseOrderBack::STATUS_SEND;
            })->edit();
            $grid->column('price', '采购价格')->if(function () use ($order) {
                return $order->status !==  ModelsPurchaseOrderBack::STATUS_SEND;
            })->edit();
            $grid->column("_", '合计')->display(function () {
                return bcmul($this->back_num, $this->price, 2);
            });
        });
       
        
    }
}
