<?php

namespace App\Admin\Renderables\Center;

use App\Models\SaleOrderModel;
use App\Models\SkuStockModel;
use Dcat\Admin\Admin;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class Sale implements Renderable
{

    public static $js = [
        // js脚本不能直接包含初始化操作，否则页面刷新后无效
        '/static/js/echarts.js',
    ];
    public static $css = [
        // 'xxx/css/page.min.css',
    ];

    public function script()
    {
        
    //     $d = json_encode(['衬衫', '羊毛衫', '雪纺衫', '裤子', '高跟鞋', '袜子']);
    //     $a = 'hehe';
        
    //     return <<<JS
    //         var myChart = echarts.init(document.getElementById('main'));
    //         console.info({$d})
    // var option = {
    //     title: {
    //         text: '{$a}'
    //     },
    //     tooltip: {},
    //     legend: {
    //         data: ['销量']
    //     },
    //     xAxis: {
    //         data:{$d}
    //     },
    //     yAxis: {},
    //     series: [{
    //         name: '销量',
    //         type: 'bar',
    //         data: [5, 20, 36, 10, 10, 20]
    //     }]
    // };

    // myChart.setOption(option);
    // JS;
    }

    public function render()
    {
        // 在这里可以引入你的js或css文件
        Admin::js(static::$js);
        Admin::css(static::$css);

        // 需要在页面执行的JS代码
        // 通过 Admin::script 设置的JS代码会自动在所有JS脚本都加载完毕后执行
        Admin::script($this->script());
        $saleOrder = SaleOrderModel::with('customer')->get();
        $sale_order_num = $saleOrder->count();
        $sale_order_money = $saleOrder->sum('total_money');

        $cost = $saleOrder->groupBy('customer_id');
        $sale_cost_title = [];
        $sale_cost_value = [];
        foreach ($cost as $item) {
            $sale_cost_title[] = $item[0]->customer->name;
            $sale_cost_value[] = $item->sum('total_money');
        }

        // dd($cost->toArray());

        
        $sale_order_list = SaleOrderModel::with('customer')->latest()->limit(10)->get();

        $r = array_map('json_encode', compact('sale_order_num', 'sale_order_money', 'sale_cost_title', 'sale_cost_value'));
        $r['sale_order_list'] = $sale_order_list;
        return view('center.sale', $r)->render();
    }
}
