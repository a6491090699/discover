<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Store;
use App\Models\Store as ModelsStore;
use App\Models\StoreCompany;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class StoreController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Store(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('store_company_id')->using(StoreCompany::pluck('title','id')->toArray());
            $grid->column('sn');
            $grid->column('position');
            $grid->column('man');
            $grid->column('tel');
            $grid->column('type')->using(ModelsStore::TYPE_LIST);
            $grid->column('save_price');
            $grid->column('move_price');
            $grid->column('title');
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
        return Show::make($id, new Store(), function (Show $show) {
            $show->field('id');
            $show->field('store_company_id');
            $show->field('sn');
            $show->field('position');
            $show->field('man');
            $show->field('tel');
            $show->field('type');
            $show->field('save_price');
            $show->field('move_price');
            $show->field('title');
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
        return Form::make(new Store(), function (Form $form) {
            $form->display('id');
            $form->text('title')->required();
            $form->select('store_company_id')->options(StoreCompany::pluck('title','id'))->required();
            $form->text('sn')->value(create_uniqid_sn('store'))->readonly()->required();
            $form->text('position')->required();
            $form->text('man')->required();
            $form->text('tel')->required();
            $form->select('type')->options(ModelsStore::TYPE_LIST)->required();
            $form->decimal('save_price')->required();
            $form->decimal('move_price')->required();
            
            
        
            $form->display('created_at');
            $form->display('updated_at');
            if ($form->isCreating()) {
                $form->saved(function($form){
                    increment_uniqid_sn('store');
                });
            }
        });
    }
}
