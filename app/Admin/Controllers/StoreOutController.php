<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\StoreOut;
use App\Admin\Repositories\StoreOutItem;
use App\Models\Delivery;
use App\Models\ProductModel;
use App\Models\Store;
use App\Models\StoreOut as ModelsStoreOut;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Layout\Content;

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
            // $grid->column('store_id');
            // $grid->column('type');
            // $grid->column('order_id');
            // $grid->column('order_type');
            // $grid->column('status');
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
            $form->text('sn')->readOnly();
            $form->datetime('out_at');
            $form->select('store_id')->options(Store::pluck('title','id'));
            $form->select('order_type')->options(ModelsStoreOut::TYPE_LIST)->load('order_id',route('pub.multi-orders'));
            $form->select('order_id');
            $form->select('status')->options(ModelsStoreOut::STATUS_LIST);
            $form->hidden('total_money');
            $form->text('car_number');
            $form->select('delivery_id')->options(Delivery::pluck('sn', 'id'));
            if ($form->isCreating()) {
                $form->hasMany('items', '', function (Form\NestedForm $table) {
                    $table->select('product_id', '名称')->options(ProductModel::pluck('name', 'id'))->loadpku(route('api.product.find'))->required();
                    $table->ipt('unit', '单位')->rem(3)->default('-')->disable();
                    $table->ipt('type', '类型')->rem(5)->default('-')->disable();
                    $table->select('sku_id', '属性')->options()->required();
                    $table->num('actual_num', '数量')->required();
                    $table->tableDecimal('price', '单价')->default(0.00)->required();
                })->useTable()->width(12)->enableHorizontal();
            }
            $form->display('created_at');
            $form->display('updated_at');
            $form->saving(function ($form) {
                $form->sn = build_order_no('CK');
                if ($form->items) {
                    $total_money = 0;
                    foreach ($form->items as $item) {
                        $total_money += $item['price'] * $item['actual_num'];
                    }
                    $form->total_money = $total_money;
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
        return Grid::make(new StoreOutItem(['sku', 'product']), function (Grid $grid) use ($id) {
            $grid->setName('items');
            $store_in = ModelsStoreOut::find($id);
            $grid->model()->where('store_out_id', $id);

            $grid->column('product.name', '产品名称');
            $grid->column('product.unit.name', '单位');
            $grid->column('product.type_str', '类型');
            $grid->column('actual_num', '数量')->if(function () use ($store_in) {
                return $store_in->status !==  ModelsStoreOut::STATUS_OUT;
            })->edit();
            $grid->column('price', '单价')->if(function () use ($store_in) {
                return $store_in->status !==  ModelsStoreOut::STATUS_OUT;
            })->edit();
            $grid->column("_", '合计')->display(function () {
                return bcmul($this->actual_num, $this->price, 2);
            });
        });
    }
}
