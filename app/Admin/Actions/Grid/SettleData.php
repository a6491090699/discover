<?php

namespace App\Admin\Actions\Grid;

use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SettleData extends RowAction
{
    /**
     * @return string
     */
    protected $title = '结算数据';

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    // public function handle(Request $request)
    // {
    //     // dump($this->getKey());

    //     return $this->response()
    //         ->success('Processed successfully: '.$this->getKey())
    //         ->redirect('/');
    // }


    public function id()
    {
        return "row-settle-{$this->getKey()}";
    }

    public function render()
    {
        parent::render();
        return <<<HTML
<span class="grid-expand">
   <a href="javascript:void(0)" id="{$this->id()}"><i class="feather icon-layout grid-action-icon"></i></a>
</span>
HTML;
    }

    /**
     * @return string|array|void
     */
    public function confirm()
    {
        // return ['Confirm?', 'contents'];
    }

    /**
     * @param Model|Authenticatable|HasPermissions|null $user
     *
     * @return bool
     */
    protected function authorize($user): bool
    {
        return true;
    }

    /**
     * @return array
     */
    protected function parameters()
    {
        return [];
    }

    public function action()
    {
        return route('financial.settle-data', [$this->getKey()]);
    }

    public function script()
    {
        return <<<JS
        $("#{$this->id()}").on("click",function(){
            var option = {
                title:'结算详情',
                type: 2,
                area: ['65%', '80%'], //宽高
                content:["{$this->action()}"],
                scrollbar:false,
                // maxmin:true,
                end: function(){
                    Dcat.reload();
                },
            };
            option.btn = ['导出excel' ,'重新生成,核算日期设为今日'];
            option.btn1 = function(index, layero){
                location.href = '{$this->action()}?_export=1';
            };

            option.btn2 = function(index, layero){
                var a = new Date();
                var today = a.toLocaleDateString();
                Dcat.NP.start();
                    $.ajax({
                        type: "GET",
                        url: '{$this->action()}?_reset='+today ,//url
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
            
            layer.open(option)
                
        })
JS;
    }
}
