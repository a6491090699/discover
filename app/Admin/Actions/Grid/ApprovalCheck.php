<?php

/*
 * // +----------------------------------------------------------------------
 * // | erp
 * // +----------------------------------------------------------------------
 * // | Copyright (c) 2006~2020 erp All rights reserved.
 * // +----------------------------------------------------------------------
 * // | Licensed ( LICENSE-1.0.0 )
 * // +----------------------------------------------------------------------
 * // | Author: yy <649109069@qq.com>
 * // +----------------------------------------------------------------------
 */

namespace App\Admin\Actions\Grid;

use App\Models\Approval;
use App\Models\BaseModel;
use Dcat\Admin\Grid\RowAction;

class ApprovalCheck extends RowAction
{
    public function id()
    {
        return "row-edit-select-resourc{$this->getKey()}";
    }

    public function render()
    {
        parent::render();
        return <<<HTML
<span class="grid-expand">
   <a href="javascript:void(0)" id="{$this->id()}"><i class="feather icon-check-circle grid-action-icon"></i></a>
</span>
HTML;
    }

    /**
     * @return string
     */
    public function action()
    {
        // return $this->resource() . "/" . $this->getKey();
        return route('approval.checkInfo', [$this->getKey()]);
    }

    /**
     * @return string
     */
    public function submitUrl()
    {
        // return $this->resource() . "/" . $this->getKey();
        return route('approval.check');
    }

    public function script()
    {
        //判断是否显示保存按钮
        //判断是否是当前审批人审批 
        $approval = Approval::find($this->getKey());
        if ($approval->check_user_ids[$approval->check_step_sort] == auth()->id()) {
            $showBtn = 'yes';
        } else {
            $showBtn = 'no';
        }

        return <<<JS
        $("#{$this->id()}").on("click",function(){
            var show_btn = '{$showBtn}';
            var option = {
                title:'审批',
                type: 2,
                area: ['65%', '80%'], //宽高
                content:["{$this->action()}"],
                scrollbar:false,
                // maxmin:true,
                end: function(){
                    Dcat.reload();
                },
                
            };
            if(show_btn == 'yes'){
                option.btn = ['审批'];
                option.btn1 = function(index, layero){

                    // var dd = $('.fields-group').parents().find('form').serialize();
                    var info =  $('#layui-layer-iframe'+index).contents().find('form');
                    // console.log(123213999);
                    // console.info(index);
                    // console.info(info.serialize());
                    // console.log(info.serialize());
                    
                    // var url = route('approval.check');
                    Dcat.NP.start();
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{$this->submitUrl()}" ,//url
                        data: info.serialize(),
                        success: function (data) {
                            if (data.status) {
                                Dcat.success(data.message);
                            } else {
                                Dcat.error(data.message);
                            }
                        },
                        error : function(a,b,c) {
                            Dcat.handleAjaxError(a, b, c);
                        },
                        complete:function(a,b) {
                            Dcat.NP.done();
                        }
                    });
                    layer.close(index);
                };
            }
            
            layer.open(option)
                
        })
JS;
    }
}
