<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\BatchCreatePro;
use App\Admin\Actions\Grid\OrderDelete;
use App\Admin\Actions\Grid\OrderPrint;
use App\Admin\Actions\Grid\OrderReview;
use App\Admin\Repositories\SaleBackOrder;
use App\Admin\Repositories\SaleBackItem;
use App\Admin\Repositories\SaleOrder;
use App\Models\AdminUser;
use App\Models\ProductModel;
use App\Models\SaleBackOrder as ModelsSaleBackOrder;
use App\Models\Store;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Layout\Content;

class SaleBackOrderController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new SaleBackOrder(['saleOrder']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('sn');
            $grid->column('saleOrder.order_no','销售合同');
            $grid->column('status')->using(ModelsSaleBackOrder::STATUS)->label(ModelsSaleBackOrder::STATUS_COLOR);
            // $grid->column('store_id');
            // $grid->column('other');
            $grid->column('review_status')->using(ModelsSaleBackOrder::REVIEW_STATUS)->label(ModelsSaleBackOrder::REVIEW_STATUS_COLOR);
            $grid->column('back_money'); 
            $grid->column('user_id')->using(AdminUser::pluck('name','id')->toArray());
            // $grid->column('back_at');
            // $grid->column('finished_at');
            $grid->column('created_at');
            // $grid->column('updated_at')->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->equal('sn');
                $filter->equal('status')->select(ModelsSaleBackOrder::STATUS);
                $filter->equal('review_status')->select(ModelsSaleBackOrder::REVIEW_STATUS);
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
        return Show::make($id, new SaleBackOrder(), function (Show $show) {
            $show->field('id');
            $show->field('sn');
            $show->field('sale_back_order_id');
            $show->field('status');
            $show->field('store_id');
            $show->field('back_money');
            $show->field('other');
            $show->field('review_status');
            $show->field('user_id');
            $show->field('back_at');
            $show->field('finished_at');
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
        return Form::make(new SaleBackOrder(), function (Form $form) {
            $form->display('id');
            $form->text('sn')->readOnly();
            $form->select('sale_back_order_id')->options(app(SaleOrder::class)->selectItems())->required();
            $form->select('status')->options(ModelsSaleBackOrder::STATUS)->required();
            $form->select('store_id')->options(Store::pluck('title','id')->toArray());
            $form->hidden('back_money')->default(0);
            $form->text('other');
            $form->select('review_status')->options(ModelsSaleBackOrder::REVIEW_STATUS)->required();
            $form->select('user_id')->options(AdminUser::pluck('name','id')->toArray())->default(auth('admin')->id())->help('未选则默认为当前用户');
            $form->datetime('back_at')->required();
            $form->hidden('finished_at');
        
            $form->display('created_at');
            $form->display('updated_at');

            if ($form->isCreating()) {
                $form->hasMany('items', '', function (Form\NestedForm $table) {
                    $table->select('product_id', '名称')->options(ProductModel::pluck('name', 'id'))->loadpku(route('api.product.find'))->required();
                    $table->ipt('unit', '单位')->rem(3)->default('-')->disable();
                    $table->ipt('type', '类型')->rem(5)->default('-')->disable();
                    $table->select('sku_id', '属性选择')->options()->required();
                    $table->num('should_num', '退货数量')->required();
                    $table->tableDecimal('price', '退货价格')->default(0.00)->required();
                })->useTable()->width(12)->enableHorizontal();
                $form->saving(function ($form) {
                    $form->sn = create_uniqid_sn('purchase_back');

                    if ($form->items) {
                        $back_money = 0;
                        foreach ($form->items as $item) {
                            $back_money += $item['price'] * $item['should_num'];
                        }
                        $form->back_money = $back_money;
                    }
                });
                $form->saved(function ($form) {
                    increment_uniqid_sn('purchase_back');
                });
            }

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
        return Grid::make(new SaleBackItem(), function (Grid $grid) use ($id) {
            $order = ModelsSaleBackOrder::find($id);
            
            // $grid->tools(OrderPrint::make());
            
            if ($order && $order->review_status !== ModelsSaleBackOrder::REVIEW_STATUS_OK) {
                $grid->tools(OrderReview::make(show_order_review($order->review_status)));
                // $grid->tools(OrderDelete::make());
                // $grid->tools(BatchCreatePro::make());
            }
            $grid->disableActions();
            $grid->disablePagination();
            $grid->disableCreateButton();
            $grid->disableBatchDelete();


            $grid->setName('items');
            $grid->model()->with(['sku.product.unit'])->where('order_id', $id);

            $grid->column('sku.product.name', '产品名称');
            $grid->column('sku.product.unit.name', '单位');
            $grid->column('sku.product.type_str', '类型');
            // $grid->column('sku_id', '属性')->if(function () use ($order) {
            //     return $order->status === ModelsPurchaseOrderBack::STATUS_SEND;
            // })->display(function () {
            //     return $this->sku['attr_value_ids_str'] ?? '';
            // })->else()->selectplus(function (Fluent $fluent) {
            //     // dd($fluent->sku);
            //     return $this->sku['attr_value_ids_str'] ?? '';
            // });
            $grid->column('should_num', '退回数量')->if(function () use ($order) {
                return $order->status !==  ModelsSaleBackOrder::STATUS_WAIT;
            })->edit();
            $grid->column('price', '价格')->if(function () use ($order) {
                return $order->status !==  ModelsSaleBackOrder::STATUS_WAIT;
            })->edit();
            $grid->column("_", '合计')->display(function () {
                return bcmul($this->should_num, $this->price, 2);
            });
        });
    }
}
