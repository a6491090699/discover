<?php

namespace App\Admin\Repositories;

use App\Models\Approval as Model;
use App\Models\Flow;
use App\Models\FlowRecord;
use App\Models\FlowStep;
use Dcat\Admin\Repositories\EloquentRepository;
use Illuminate\Support\Facades\DB;

class Approval extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    /**
     * 添加审批
     *
     * @return void
     */
    public function add($approval_id)
    {
        $approval = Model::find($approval_id);

        $flow = $approval->flow;

        //flow_steps
        $steps = [];
        $check_user_ids = data_get($flow->flow_list, '*.id');

        foreach ($check_user_ids as $key => $item) {
            $steps[] = new FlowStep([
                'flow_uid' => $item,
                'sort' => $key,
            ]);
        }
        $approval->flowSteps()->saveMany($steps);

        //发送通知
        app(Message::class)->add($approval->user_id, $check_user_ids[0], '您有新审批单未审批', 2, route('approvals.index', ['dtype' => 1]));
    }

    public function check($approval_id, $user_id, $status, $data = '')
    {
        DB::beginTransaction();
        $approval = Model::find($approval_id);
        if (in_array($user_id, $approval->check_user_ids)) {
            $flow = $approval->flow;
            $cc = [];
            foreach ($flow->template->fields as $item) {
                if (isset($data[$item['field']])) {
                    $cc[$item['field']] = $data[$item['field']];
                }
            }

            $approval->flowRecords()->save(new FlowRecord([
                'step_id' => $approval->flowSteps()->where('flow_uid', $user_id)->value('id'),
                'check_user_id' => $user_id,
                'content' => '',
                'status' => $status,
            ]));
            $approval->last_user_id = $user_id;
            $flow_user_ids = $approval->flow_user_ids;
            
            array_push($flow_user_ids, (string)$user_id);
            $approval->flow_user_ids = $flow_user_ids;
            $approval->content = json_encode($cc, JSON_UNESCAPED_UNICODE);

            //审核失败
            if ($status == 2) {
                $approval->check_status = Model::STATUS_FAIL;
                $approval->save();
                return true;
            }
            //是否最后一个
            $check_user_ids = $approval->check_user_ids;
            if (auth()->id() == array_pop($check_user_ids)) {
                $approval->check_status = Model::STATUS_SUCCESS;
            } else {
                $approval->check_step_sort = $approval->check_step_sort + 1;
                $approval->next_user_id = $approval->check_user_ids[$approval->check_step_sort];
                //发送通知
                app(Message::class)->add($approval->user_id, $approval->next_user_id, '您有新审批单未审批', 2, route('approvals.index', ['dtype' => 1]));
            }
            $approval->save();
            DB::commit();
            return true;
            

        } else {
            DB::rollBack();
            return false;
        }
    }

    /**
     * Undocumented function
     * 1.我的待办
     * 2.我发起的
     * 3.我处理的
     * 4.抄送我的 (没有)
     *
     * @param [type] $user_id 用户id
     * @param [type] $dtype 数据类型 
     * @param integer $page
     * @param integer $pagesize
     * @return void
     */
    public function list($user_id, $dtype = 2, $page = 1, $pagesize = 10)
    {
        $query = Model::with('flowSteps', 'flowRecords', 'flow')->query();
        switch ($dtype) {
            case 1:
                //我的待办
                $query = $query->where('check_status', Model::STATUS_ING)->whereHas('flowSteps', function ($query) use ($user_id) {
                    $query->where('flow_uid', $user_id);
                });

                break;
            case 2:
                //我发起的
                $query = $query->where('user_id', $user_id);
                break;
            case 3:
                //我处理的
                $query = $query->whereIn('check_status', [Model::STATUS_SUCCESS, Model::STATUS_FAIL])->whereHas('flowSteps', function ($query) use ($user_id) {
                    $query->where('flow_uid', $user_id);
                });
                break;
            case 4:
                //抄送我的

                break;
            default:
        }

        $data = $query->paginate($pagesize, '*', 'page', $page);
        return $data;
    }

    public function view()
    {
    }

    /**
     * 撤回操作  只属于创建者  
     * 置为已撤回状态  单不复用
     *
     * @return void
     */
    public function revoke($approval_id)
    {
        $approval = Model::find($approval_id);
        $approval->check_status = Model::STATUS_REVOKE;
        $approval->save();

        // //删除step的数据
        // $approval->flowSteps()->delete();
        // //删除record数据
    }
}
