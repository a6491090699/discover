<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\ApprovalCheck;
use App\Admin\Actions\Grid\ApprovalPrint;
use App\Admin\Repositories\Approval;
use App\Admin\Repositories\Flow;
use App\Models\AdminUser;
use App\Models\Approval as ModelsApproval;
use App\Models\Flow as ModelsFlow;
use App\Models\FlowRecord;
use App\Models\Template;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Form\NestedForm;
use Dcat\Admin\Layout\Content;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApprovalController extends AdminController
{
    public function title()
    {
        $dtype = request()->input('dtype', 1);
        switch ($dtype) {
            case 1:
                $title = '我的待办';
                break;
            case 2:
                $title = '我发起的';
                break;
            case 3:
                $title = '我处理的';
                break;
            case 4:
                $title = '抄送我的';
                break;
            default:
                $title = '审批列表';
        }
        return $title;
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        if (!request()->filled('dtype')) {
            abort(404);
        }
        return Grid::make(new Approval(), function (Grid $grid) {
            $dtype = request()->input('dtype', 1);
            $user_id = auth()->id();
            switch ($dtype) {
                case 1:
                    //我的待办
                    $grid->model()->with('flowSteps', 'flowRecords', 'flow')->whereIn('check_status', [ModelsApproval::STATUS_ING, ModelsApproval::STATUS_NO])->whereHas('flowSteps', function ($query) use ($user_id) {
                        $query->where('flow_uid', $user_id);
                    })->where('next_user_id', $user_id);

                    $grid->actions(new ApprovalCheck());

                    $grid->disableQuickEditButton();

                    break;
                case 2:
                    //我发起的
                    $grid->model()->with('flowSteps', 'flowRecords', 'flow')->where('user_id', $user_id);
                    //审核中 就不能编辑了 todo
                    $grid->actions(function (Grid\Displayers\Actions $actions) {
                        // 当前行的数据数组
                        $rowArray = $actions->row->toArray();

                        if (auth()->id() !== $rowArray['user_id'] || $rowArray['check_status'] != ModelsApproval::STATUS_NO) {
                            $actions->disableQuickEdit();
                        }
                        $actions->disableView(false);
                    });
                    break;
                case 3:
                    //我处理的
                    $grid->model()->with('flowSteps', 'flowRecords', 'flow')->whereHas('flowSteps', function ($query) use ($user_id) {
                        $query->where('flow_uid', $user_id);
                    });
                    $grid->disableQuickEditButton();
                    $grid->actions(function (Grid\Displayers\Actions $actions) {
                        // 当前行的数据数组
                        $rowArray = $actions->row->toArray();
                        $actions->disableView(false);
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


            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('title');
                $filter->equal('flow_id')->select(app(Flow::class)->selectItems());
                $filter->equal('user_id')->select(AdminUser::pluck('name', 'id')->toArray());
                $filter->equal('check_status')->select(ModelsApproval::STATUS_LIST);
                $filter->between('created_at', '申请时间')->datetime();
            });
        });
    }

    public function checkInfo($id, Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description()['show'] ?? trans('admin.show'))
            ->body($this->detail($id))
            ->body($this->items()->edit($id))->full();
    }

    public function check()
    {
        if (request()->filled(['id', 'status'])) {

            $data = request()->all();

            if (app(Approval::class)->check($data['id'], auth()->id(), $data['status'] ?? 0, $data)) {
                return response()->json(['status' => 1, 'message' => '操作成功']);
            } else {
                return response()->json(['status' => 0, 'message' => '操作失败']);
            }
        }
        return response()->json(['status' => 0, 'message' => '请选择审核状态']);
    }

    /**
     * Make a show builder.
     * 审批详情
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Approval(), function (Show $show) {
            $show->disableDeleteButton();
            $show->disableEditButton();
            $show->disableListButton();
            $show->field('id');
            $show->field('title');
            $show->field('flow_id')->using(app(Flow::class)->selectItems());
            // $show->field('content');
            $show->field('remark');
            $show->field('user_id')->using(AdminUser::pluck('name', 'id')->toArray());
            // $show->field('check_step_sort');
            $show->field('check_user_ids')->as(function () {
                $users = AdminUser::whereIn('id', $this->check_user_ids)->pluck('name', 'id');
                $r = '';
                foreach ($this->check_user_ids as $i) {
                    $r .= $users[$i] . '>>>';
                }
                return rtrim($r, '>>>');
            });
            $show->field('first_man', '当前审批人')->as(function () {
                $uid = $this->check_user_ids[$this->check_step_sort];
                return AdminUser::where('id', $uid)->value('name');
            });
            $show->field('next_man', '下一个审批人')->as(function () {
                $nextid = min($this->check_step_sort + 1, count($this->check_user_ids) - 1);
                $uid = $this->check_user_ids[$nextid];
                return AdminUser::where('id', $uid)->value('name') ?? '';
            });
            if ($show->model()->template_id) {
                $show->divider();
                $show->html('<div class="box-header with-border" style="padding: .65rem 1rem">
                <h3 class="box-title" style="line-height:30px;">审批单详情</h3></div>');
                $flow = ModelsFlow::find($show->model()->flow_id);
                foreach ($flow->template->fields as $item) {

                    $show->field($item['field'], $item['name'])->as(function ($i) use ($item) {
                        $content = json_decode($this->content, JSON_UNESCAPED_UNICODE);
                        return $content[$item['field']] ?? '';
                    });
                }
            }
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
                    $form->text('check_user_ids')->customFormat(function ($item) {
                        $users = AdminUser::whereIn('id', $this->check_user_ids)->pluck('name', 'id');
                        $r = '';
                        foreach ($this->check_user_ids as $i) {
                            $r .= $users[$i] . '>>>';
                        }
                        return rtrim($r, '>>>');
                    })->disable();

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
                if ($form->isCreating()) {
                    $form->hidden('check_user_ids');
                }

                $form->hidden('check_step_sort');
                $form->hidden('content');
                $form->hidden('next_user_id');
                // $form->select('check_status')->options(ModelsApproval::STATUS_LIST)->default(0);
                $form->hidden('check_status')->value(ModelsApproval::STATUS_NO);
                $form->text('remark');

                $form->display('created_at');
                $form->display('updated_at');
            });


            if ($form->isEditing()) {
                if ($form->model()->template_id) {
                    $form->tab('审批单设置', function (Form $form) {
                        $flow = ModelsFlow::find($form->model()->flow_id);
                        foreach ($flow->template->fields as $item) {
                            $form->textarea($item['field'], $item['name'])->customFormat(function ($i) use ($item) {
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
            }

            $form->saving(function (Form $form) {
                if ($form->isCreating()) {
                    $form->user_id = auth()->id();
                    $form->check_step_sort = 0;
                    $flow_list = data_get(ModelsFlow::where('id', $form->flow_id)->value('flow_list'), '*.id');
                    $form->check_user_ids = $flow_list;
                    $form->next_user_id = $flow_list[0];
                    // $form->check_user_ids = [2,1];
                }
                if ($form->isEditing()) {
                    if ($form->model()->template_id) {
                        $flow = ModelsFlow::find($form->model()->flow_id);
                        $content_data = [];
                        foreach ($flow->template->fields as $item) {
                            $content_data[$item['field']] = $form->input($item['field']);
                            $form->deleteInput($item['field']);
                        }
                        $form->content = json_encode($content_data);
                    }
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

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function items()
    {
        return Form::make(new Approval(), function (Form &$form) {
            $form->title('审批单编辑');
            $form->disableListButton();
            $form->disableViewButton();
            $form->disableDeleteButton();
            $form->disableResetButton();
            $form->disableEditingCheck();
            $form->disableViewCheck();
            $form->disableSubmitButton();
            $form->hidden('id');
            $form->hidden('content');
            $form->select('status', '审批状态')->options(FlowRecord::STATUS_LIST)->required();
            // $form->hidden('after-save')->value(3);

            if ($form->isEditing()) {

                $flow = ModelsFlow::find($form->model()->flow_id);
                foreach ($flow->template->fields as $item) {
                    $form->textarea($item['field'], $item['name'])->customFormat(function ($i) use ($item) {
                        $content = json_decode($this->content, JSON_UNESCAPED_UNICODE);
                        return $content[$item['field']] ?? '';
                    });
                }
            }
        });
    }
}
