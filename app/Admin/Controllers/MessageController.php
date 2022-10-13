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
            $grid->column('is_read')->using(['未读', '已读'])->dot(['primary', 'success']);
            // $grid->column('type');
            $grid->column('to_url')->link();
            $grid->column('created_at');
            // $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
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
            $form->text('from_uid');
            $form->text('to_uid');
            $form->text('content');
            $form->text('is_read');
            $form->text('type');
            $form->text('to_url');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
