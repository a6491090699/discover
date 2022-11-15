<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Flow;
use App\Models\AdminUser;
use App\Models\Flow as ModelsFlow;
use App\Models\Template;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Form\NestedForm;

class FlowController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Flow(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('check_type')->using(ModelsFlow::CHECK_TYPE_LIST);
            $grid->column('created_at');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('title');
                $filter->equal('check_type')->select(ModelsFlow::CHECK_TYPE_LIST);
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
        return Show::make($id, new Flow(), function (Show $show) {
            $show->field('id');
            $show->field('check_type');
            $show->field('title');
            $show->field('remark');
            $show->field('flow_list');
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
        return Form::make(new Flow(), function (Form $form) {
            $form->display('id');

            $form->text('title')->required();
            $form->select('check_type')->options(ModelsFlow::CHECK_TYPE_LIST)->default(ModelsFlow::CHECK_TYPE_ZHIDING)->when(ModelsFlow::CHECK_TYPE_ZHIDING, function (Form $form) {
                // $form->listbox('flow_list', '会签人')->options(AdminUser::pluck('name', 'id')->toArray())->help('按顺序会签');
                //todo 不能排序  用table做 
                $form->table('flow_list' ,'会签人' , function(NestedForm $table){
                    $table->select('id','用户')->options(AdminUser::pluck('name', 'id')->toArray());
                })->help('按顺序会签');
                // $form->table('fields', function (NestedForm $table) {
                //     $table->text('name','字段名');
                //     $table->text('field','字段');
                // });
            })->required();
            $form->select('template_id', '审批模板')->options(Template::where('type',Template::TYPE_SHENPI)->pluck('title', 'id')->toarray())->required();
            $form->text('remark');
            $form->display('created_at');
            $form->display('updated_at');
            $form->saving(function(Form $form){
                if($form->isCreating()){
                    $form->user_id = auth()->id();
                }
            });
        });
    }
}
