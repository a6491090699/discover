<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Department;
use App\Models\Company;
use App\Models\Department as ModelsDepartment;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class DepartmentController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        // return new Tree(new $menuModel(), function (Tree $tree) {
        //     $tree->disableCreateButton();
        //     $tree->disableQuickCreateButton();
        //     $tree->disableEditButton();

        //     $tree->branch(function ($branch) {
        //         $payload = "<i class='fa {$branch['icon']}'></i>&nbsp;<strong>{$branch['title']}</strong>";

        //         if (! isset($branch['children'])) {
        //             if (url()->isValidUrl($branch['uri'])) {
        //                 $uri = $branch['uri'];
        //             } else {
        //                 $uri = admin_base_path($branch['uri']);
        //             }

        //             $payload .= "&nbsp;&nbsp;&nbsp;<a href=\"$uri\" class=\"dd-nodrag\">$uri</a>";
        //         }

        //         return $payload;
        //     });
        // });

        return Grid::make(new Department(['company']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title')->tree();
            $grid->column('company.title');
            $grid->column('parent_id');
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
        return Show::make($id, new Department(), function (Show $show) {
            $show->field('id');
            $show->field('company_id');
            $show->field('parent_id');
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
        return Form::make(new Department(), function (Form $form) {
            $form->display('id');

            $form->text('title');

            $form->select('company_id')->options(Company::pluck('title','id'));
            $form->select('parent_id')->options(function (){
                return ModelsDepartment::selectOptions();
            })->saving(function ($v) {
                return (int) $v;
            });

            // $form->select('parent_id')->options(function (){
            //     return ModelsDepartment::selectOptions();
            // })->saving(function ($v) {
            //     return (int) $v;
            // });

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
