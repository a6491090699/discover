<?php

namespace App\Admin\Renderables\Center;

use App\Admin\Repositories\SkuStock;
use App\Models\CustomerModel;
use App\Models\SkuStockModel;
use App\Models\SupplierModel;
use Dcat\Admin\Admin;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class Basic implements Renderable
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
        $sku_info = DB::select('select sum(ss.num) as num,pc.title from sku_stock ss left join product_sku ps on ss.sku_id = ps.id left join product p on p.id = ps.product_id left join product_categories pc on pc.id = p.category_id group by p.category_id');
        $sku_info = json_encode($sku_info ,JSON_UNESCAPED_UNICODE);
        $sku_info = json_decode($sku_info,true);

        // dd(json_decode($sku_info,true) );
        $sku = [];
        $sku_title =  json_encode(data_get($sku_info ,'*.title'));
        $sku_num =  json_encode(data_get($sku_info ,'*.num'));
        $sku_total = array_sum(data_get($sku_info ,'*.num'));
        $supplier_total = SupplierModel::count();
        $customer_total = CustomerModel::count();
        $store_info = json_encode(app(SkuStock::class)->countStoreNum());
        
        return view('center.basic' ,compact('sku_title','sku_num','sku_total','store_info','supplier_total','customer_total'))->render();
    }
}
