<div id="main" style="width: 600px;height:400px;"></div>
<script src="/static/js/echarts.js"></script>

<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('main'));

    // 指定图表的配置项和数据
    var option = {
        title: {
            text: 'ECharts 入门示例'
        },
        tooltip: {},
        legend: {
            data: ['销量']
        },
        xAxis: {
            data: {!! $d !!}
        },
        yAxis: {},
        series: [{
            name: '销量',
            type: 'bar',
            data: [5, 20, 36, 10, 10, 20]
        }]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>

<script>
    Dcat.ready(function() {
        // js代码也可以放在模板里面
        console.log('所有JS脚本都加载完了!!!');
    });
</script>
