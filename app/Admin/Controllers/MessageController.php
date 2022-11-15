<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Message;
use App\Models\AdminUser;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class MessageController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Message(), function (Grid $grid) {
            $grid->model()->where('to_uid', auth()->id());
            $grid->column('id')->sortable();
            $grid->column('from_uid')->using(AdminUser::pluck('name','id')->toArray());
            // $grid->column('to_uid');
            $grid->column('content');
            // $grid->column('is_read')->using(['未读', '已读'])->dot(['primary', 'success']);
            $grid->column('is_read')->switch();
            // $grid->column('type');
            $grid->column('to_url')->display(function($url){
                return '<a href="'.$url.'">点我跳转</a>';
            });
            $grid->column('created_at');
            // $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->equal('from_uid')->select(AdminUser::pluck('name','id')->toArray());
                $filter->equal('is_read','状态')->select(['未读','已读']);
            });
            // $grid->disableCreateButton();
            $grid->disableEditButton();
            $grid->disableQuickEditButton();
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
        return Show::make($id, new Message(), function (Show $show) {
            $show->field('id');
            $show->field('from_uid');
            $show->field('to_uid');
            $show->field('content');
            $show->field('is_read');
            $show->field('type');
            $show->field('to_url');
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
        return Form::make(new Message(), function (Form $form) {
            $form->display('id');
            $form->select('from_uid')->options(AdminUser::pluck('name','id')->toArray());
            $form->select('to_uid')->options(AdminUser::pluck('name','id')->toArray());
            $form->textarea('content');
            $form->hidden('is_read')->value(0);
            $form->hidden('type');
            $form->hidden('to_url');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
