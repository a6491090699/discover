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

use App\Models\BaseModel;
use Dcat\Admin\Grid\RowAction;

class PreviewTemplate extends RowAction
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
   <a href="javascript:void(0)" id="{$this->id()}" title="预览"><i class="fa fa-binoculars grid-action-icon"></i></a>
</span>
HTML;
    }

    /**
     * @return string
     */
    public function action()
    {
        return route('template.preview', [$this->getKey()]);
    }

    public function script()
    {
        /*跳转预览 可打印*/
        //         return <<<JS
        //         $("#{$this->id()}").on("click",function(){
        //             location.href="{$this->action()}";
        //         })
        // JS;
        /**弹窗预览 */
        return <<<JS
                $("#{$this->id()}").on("click",function(){
                    var option = {
                        title:'模板预览',
                        type: 2,
                        area: ['50%', '70%'], //宽高
                        content:["{$this->action()}"],
                        scrollbar:false,
                        // maxmin:true,
                        end: function(){
                            Dcat.reload();
                        },
                    };
                    layer.open(option)

                })
        JS;
    }
}
