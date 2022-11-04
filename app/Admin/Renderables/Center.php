<?php

namespace App\Admin\Renderables;

use Dcat\Admin\Admin;
use Illuminate\Contracts\Support\Renderable;

class Center implements Renderable
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
        $d = json_encode(['衬衫', '羊毛衫', '雪纺衫', '裤子', '高跟鞋', '袜子']);
        return view('center.index' ,compact('d'))->render();
    }
}
