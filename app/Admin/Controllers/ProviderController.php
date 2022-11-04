<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Provider;
use App\Models\Provider as ModelsProvider;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class ProviderController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Provider(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('sn');
            $grid->column('type')->using(ModelsProvider::TYPE_LIST);
            $grid->column('address');
            $grid->column('status')->using(ModelsProvider::STATUS_LIST);
            $grid->column('link');
            // $grid->column('contact_department');
            // $grid->column('contact_email');
            // $grid->column('phone');
            // $grid->column('contact_tel');
            // $grid->column('bank_title');
            // $grid->column('bank_name');
            // $grid->column('bank_account');
            // $grid->column('bank_top');
            $grid->column('created_at');
            // $grid->column('updated_at')->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                
                $filter->like('name');
                $filter->equal('type')->select(ModelsProvider::TYPE_LIST);
                $filter->equal('status')->select(ModelsProvider::STATUS_LIST);
                $filter->equal('sn');
        
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
        return Show::make($id, new Provider(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('sn');
            $show->field('type');
            $show->field('address');
            $show->field('status');
            $show->field('link');
            $show->field('contact_department');
            $show->field('contact_email');
            $show->field('phone');
            $show->field('contact_tel');
            $show->field('bank_title');
            $show->field('bank_name');
            $show->field('bank_account');
            $show->field('bank_top');
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
        return Form::make(new Provider(), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->text('sn')->value(create_uniqid_sn('provider'))->readonly()->required();
            $form->select('type')->options(ModelsProvider::TYPE_LIST);
            $form->text('address');
            $form->select('status')->options(ModelsProvider::STATUS_LIST);
            $form->text('link');
            $form->text('contact_department');
            $form->text('contact_email');
            $form->text('phone');
            $form->text('contact_tel');
            $form->text('bank_title');
            $form->text('bank_name');
            $form->text('bank_account');
            $form->text('bank_top');
        
            $form->display('created_at');
            $form->display('updated_at');
            if ($form->isCreating()) {
                $form->saved(function($form){
                    increment_uniqid_sn('provider');
                });
            }
        });
    }
}
