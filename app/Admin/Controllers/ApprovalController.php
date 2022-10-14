<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\ApprovalPrint;
use App\Admin\Repositories\Approval;
use App\Admin\Repositories\Flow;
use App\Models\AdminUser;
use App\Models\Approval as ModelsApproval;
use App\Models\Flow as ModelsFlow;
use App\Models\Template;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Form\NestedForm;
use Illuminate\Support\Facades\DB;

class ApprovalController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Approval(), function (Grid $grid) {
            $dtype = request()->input('dtype', 0);
            $user_id = auth()->id();
            switch ($dtype) {
                case 1:
                    //我的待办
                    $grid->model()->with('flowSteps', 'flowRecords', 'flow')->where('check_status', ModelsApproval::STATUS_ING)->whereHas('flowSteps', function ($query) use ($user_id) {
                        $query->where('flow_uid', $user_id);
                    });

                    break;
                case 2:
                    //我发起的
                    $grid->model()->with('flowSteps', 'flowRecords', 'flow')->where('user_id', $user_id);
                    break;
                case 3:
                    //我处理的
                    $grid->model()->with('flowSteps', 'flowRecords', 'flow')->whereIn('check_status', [ModelsApproval::STATUS_SUCCESS, ModelsApproval::STATUS_FAIL])->whereHas('flowSteps', function ($query) use ($user_id) {
                        $query->where('flow_uid', $user_id);
                    });
                    break;
                case 4:
                    //抄送我的

                    break;
                default:
            }
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('flow_id')->using(app(Flow::class)->selectItems());
            // $grid->column('content');
            // $grid->column('end_at');
            $grid->column('user_id')->using(AdminUser::pluck('name', 'id')->toArray());
            // $grid->column('check_step_sort');
            // $grid->column('check_user_ids');
            // $grid->column('flow_user_ids');
            $grid->column('check_status')->using(ModelsApproval::STATUS_LIST);
            // $grid->column('remark');
            // $grid->column('last_user_id');
            $grid->column('created_at');
            $grid->actions(new ApprovalPrint());

            $grid->actions(function (Grid\Displayers\Actions $actions) {
                // 当前行的数据数组
                $rowArray = $actions->row->toArray();

                // if (auth()->id() !== $rowArray['user_id'] || $rowArray['check_status'] != ModelsApproval::STATUS_NO) {
                //     $actions->disableQuickEdit();
                // }
                // $actions->disableView(false);

                //todo action审批按钮
            });
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
        return Show::make($id, new Approval(), function (Show $show) {
            $show->field('id');
            $show->field('flow_id');
            $show->field('content');
            $show->field('remark');
            $show->field('user_id');
            $show->field('check_step_sort');
            $show->field('check_user_ids');
            $show->field('flow_user_ids');
            $show->field('check_status');
            $show->field('last_user_id');
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
        return Form::make(new Approval(), function (Form $form) {
            $form->tab('基本信息', function (Form $form) {
                $form->display('id');
                $form->text('title');
                $form->select('flow_id')->options(app(Flow::class)->selectItems());
                $form->hidden('user_id');
                //当前审批人
                if ($form->isEditing()) {
                    $form->multipleSelect('check_user_ids')->options(AdminUser::pluck('name', 'id')->toArray())->disable();

                    $form->text('first_man', '当前审批人')->customFormat(function ($item) {
                        $uid = $this->check_user_ids[$this->check_step_sort];
                        return AdminUser::where('id', $uid)->value('name');
                    })->disable();
                    //下个审批人
                    $form->text('next_man', '下个审批人')->customFormat(function ($item) {
                        $nextid = min($this->check_step_sort + 1, count($this->check_user_ids) - 1);
                        $uid = $this->check_user_ids[$nextid];
                        return AdminUser::where('id', $uid)->value('name') ?? '';
                    })->disable();
                }

                $form->hidden('check_step_sort');
                $form->hidden('content');
                $form->select('check_status')->options(ModelsApproval::STATUS_LIST)->default(0);
                $form->text('remark');

                $form->display('created_at');
                $form->display('updated_at');
            });


            if ($form->isEditing()) {
                $form->tab('审批单设置', function (Form $form) {
                    $flow = ModelsFlow::find($form->model()->flow_id);
                    foreach ($flow->template->fields as $item) {
                        $form->text($item['field'], $item['name'])->customFormat(function ($i) use ($item) {
                            $content = json_decode($this->content, JSON_UNESCAPED_UNICODE);
                            return $content[$item['field']] ?? '';
                        });
                    }
                    // $form->table('content', function (NestedForm $form) use ($flow) {
                    //     foreach ($flow->template->fields as $item) {
                    //         $form->text($item['field'], $item['name']);
                    //     }
                    // });
                });
            }

            $form->saving(function (Form $form) {
                if ($form->isCreating()) {
                    $form->user_id = auth()->id();
                    $form->check_step_sort = 0;
                    $form->check_user_ids = ModelsFlow::where('id', $form->flow_id)->value('flow_list');
                }
                if ($form->isEditing()) {
                    $flow = ModelsFlow::find($form->model()->flow_id);
                    $content_data = [];
                    foreach ($flow->template->fields as $item) {
                        $content_data[$item['field']] = $form->input($item['field']);
                        $form->deleteInput($item['field']);
                    }
                    $form->content = json_encode($content_data);
                    $form->deleteInput('check_user_ids');
                }
            });

            $form->saved(function (Form $form) {
                if ($form->isCreating()) {
                    $newId = $form->getKey();
                    $data = $form->updates();
                    app(Approval::class)->add($newId);
                }
            });
        });
    }
}
