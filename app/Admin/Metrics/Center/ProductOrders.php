<?php

/*
 * // +----------------------------------------------------------------------
 * // | erp
 * // +----------------------------------------------------------------------
 * // | Copyright (c) 2006~2020 erp All rights reserved.
 * // +----------------------------------------------------------------------
 * // | Licensed ( LICENSE-1.0.0 )
 * // +----------------------------------------------------------------------
 * // | Author: yxx <1365831278@qq.com>
 * // +----------------------------------------------------------------------
 */

namespace App\Admin\Metrics\Center;

use Dcat\Admin\Widgets\Metrics\Round;
use Illuminate\Http\Request;

class ProductOrders extends Round
{
    /**
     * 初始化卡片内容
     */
    protected function init()
    {
        parent::init();

        $this->title('物流详情');
        $this->chartLabels(['已收货', '运输中', '已退回']);
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
                $this->withContent(23043, 14658, 4758);

                // 图表数据
                $this->withChart([70, 52, 26]);

                // 总数
                $this->chartTotal('合计', 344);
        }
    }

    /**
     * 设置图表数据.
     *
     * @param array $data
     *
     * @return $this
     */
    public function withChart(array $data)
    {
        return $this->chart([
            'series' => $data,
        ]);
    }

    /**
     * 卡片内容.
     *
     * @param int $finished
     * @param int $pending
     * @param int $rejected
     *
     * @return $this
     */
    public function withContent($finished, $pending, $rejected)
    {
        return $this->content(
            <<<HTML
<div class="col-12 d-flex flex-column flex-wrap text-center" style="max-width: 220px">
    <div class="chart-info d-flex justify-content-between mb-1 mt-2" >
          <div class="series-info d-flex align-items-center">
              <i class="fa fa-circle-o text-bold-700 text-primary"></i>
              <span class="text-bold-600 ml-50">已收货</span>
          </div>
          <div class="product-result">
              <span>{$finished}</span>
          </div>
    </div>

    <div class="chart-info d-flex justify-content-between mb-1">
          <div class="series-info d-flex align-items-center">
              <i class="fa fa-circle-o text-bold-700 text-warning"></i>
              <span class="text-bold-600 ml-50">运输中</span>
          </div>
          <div class="product-result">
              <span>{$pending}</span>
          </div>
    </div>

     <div class="chart-info d-flex justify-content-between mb-1">
          <div class="series-info d-flex align-items-center">
              <i class="fa fa-circle-o text-bold-700 text-danger"></i>
              <span class="text-bold-600 ml-50">已退回</span>
          </div>
          <div class="product-result">
              <span>{$rejected}</span>
          </div>
    </div>
</div>
HTML
        );
    }
}
