<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\FeeType;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class FeeTypeController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new FeeType(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('has_caozuo')->using(['否','是']);
            $grid->column('has_zhanyong')->using(['否','是']);
            $grid->column('created_at');
        
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
        return Show::make($id, new FeeType(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('has_caozuo');
            $show->field('has_zhanyong');
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
        return Form::make(new FeeType(), function (Form $form) {
            $form->display('id');
            $form->text('title');
            $form->switch('has_caozuo');
            $form->switch('has_zhanyong');
        
            // $form->display('created_at');
            // $form->display('updated_at');
        });
    }
}
