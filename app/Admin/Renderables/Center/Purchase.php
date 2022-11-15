<?php

namespace App\Admin\Renderables\Center;

use App\Admin\Repositories\PurchaseOrder;
use App\Models\PurchaseOrderBack;
use App\Models\PurchaseOrderModel;
use App\Models\SkuStockModel;
use App\Models\StoreIn;
use Dcat\Admin\Admin;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class Purchase implements Renderable
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
        $purchase = PurchaseOrderModel::with('supplier')->get();
        $order_num = $purchase->count();
        $order_money = $purchase->sum('total_money');

        $cost = $purchase->groupBy('supplier_id');
        $cost_title = [];
        $cost_value = [];
        foreach ($cost as $item) {
            $cost_title[] = $item[0]->supplier->name;
            $cost_value[] = $item->sum('total_money');
        }

        // dd($cost->toArray());

        $store_in_info = StoreIn::where('status', StoreIn::STATUS_IN)->selectRaw('DATE_FORMAT(in_at ,"%Y-%m") as in_month,id')->orderBy('in_at', 'asc')->get();
        $store_in_info = $store_in_info->groupBy('in_month')->toArray();
        foreach ($store_in_info as $key => $item) {
            $store_in_info[$key]  = count($item);
        }
        $store_in_info_title = array_keys($store_in_info);
        $store_in_info_value = array_values($store_in_info);


        $purchase_back = PurchaseOrderBack::where('status', PurchaseOrderBack::STATUS_SEND)->selectRaw('DATE_FORMAT(back_at ,"%Y-%m") as back_month,id')->orderBy('back_at', 'asc')->get();
        $purchase_back = $purchase_back->groupBy('back_month')->toArray();
        foreach ($purchase_back as $key => $item) {
            $purchase_back[$key]  = count($item);
        }
        $purchase_back_title = array_keys($purchase_back);
        $purchase_back_value = array_values($purchase_back);
        $purchase_list = PurchaseOrderModel::with('supplier')->latest()->limit(10)->get();

        $r = array_map('json_encode', compact('order_num', 'order_money', 'cost_title', 'cost_value', 'store_in_info_title', 'store_in_info_value', 'purchase_back_title', 'purchase_back_value'));
        $r['purchase_list'] = $purchase_list;
        return view('center.purchase', $r)->render();
    }
}
