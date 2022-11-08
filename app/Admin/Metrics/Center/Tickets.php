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

namespace App\Admin\Metrics\Center;

use Dcat\Admin\Widgets\Metrics\RadialBar;
use Illuminate\Http\Request;

class Tickets extends RadialBar
{
    /**
     * 初始化卡片内容
     */
    protected function init()
    {
        parent::init();

        $this->title('合同数据');
        $this->height(400);
        $this->chartHeight(300);
        $this->chartLabels('已完成的合同');
        $this->dropdown([
            '7' => '过去7天',
            '28' => '过去28天',
            '30' => '上个月',
            '365' => '上一年',
        ]);
    }

    /**
     * 处理请求
     *
     * @param Request $request
     *
     * @return mixed|void
     */
    public function handle(Request $request)
    {
        switch ($request->get('option')) {
            case '365':
            case '30':
            case '28':
            case '7':
            default:
                // 卡片内容
                $this->withContent(162);
                // 卡片底部
                $this->withFooter(29, 63, '1d');
                // 图表数据
                $this->withChart(83);
        }
    }

    /**
     * 设置图表数据.
     *
     * @param int $data
     *
     * @return $this
     */
    public function withChart(int $data)
    {
        return $this->chart([
            'series' => [$data],
        ]);
    }

    /**
     * 卡片内容
     *
     * @param string $content
     *
     * @return $this
     */
    public function withContent($content)
    {
        return $this->content(
            <<<HTML
<div class="d-flex flex-column flex-wrap text-center">
    <h1 class="font-lg-2 mt-2 mb-0">{$content}</h1>
    <!-- <small>Tickets</small> -->
</div>
HTML
        );
    }

    /**
     * 卡片底部内容.
     *
     * @param string $new
     * @param string $open
     * @param string $response
     *
     * @return $this
     */
    public function withFooter($new, $open, $response)
    {
        return $this->footer(
            <<<HTML
<div class="d-flex justify-content-between p-1" style="padding-top: 0!important;">
    <div class="text-center">
        <p>新增的合同</p>
        <span class="font-lg-1">{$new}</span>
    </div>
    <div class="text-center">
        <p>进行中的合同</p>
        <span class="font-lg-1">{$open}</span>
    </div>
    <div class="text-center">
        <p>已结算的合同</p>
        <span class="font-lg-1">{$response}</span>
    </div>
</div>
HTML
        );
    }
}
