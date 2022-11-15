<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Template;
use App\Models\Template as ModelsTemplate;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Form\NestedForm;

class TemplateController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Template(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('slug','模板页面文件名')->display(function($slug){
                return $slug.'.blade.php';
            });
            $grid->column('type','类型')->using(ModelsTemplate::TYPE_LIST);
            // $grid->column('fields');
            $grid->column('status')->using(ModelsTemplate::STATUS_LIST)->label(ModelsTemplate::STATUS_COLOR);
            $grid->column('created_at');
            // $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('title');
                $filter->equal('type')->select(ModelsTemplate::TYPE_LIST);
                $filter->equal('status')->select(ModelsTemplate::STATUS_LIST);
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
        return Show::make($id, new Template(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('slug');
            $show->field('fields');
            $show->field('status');
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
        return Form::make(new Template(), function (Form $form) {
            $form->display('id');
            $form->text('title');
            $form->text('slug');
            $form->table('fields', function (NestedForm $table) {
                $table->text('name','字段名');
                $table->text('field','字段');
            });
            $form->select('type','类型')->options(ModelsTemplate::TYPE_LIST)->default(ModelsTemplate::TYPE_SHENPI);

            $form->select('status')->options(['禁用', '启用']);

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
