<div class="alert alert-info" role="alert">进货报表</div>
<div class="row">
    
    <div class="col-md-6">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-product-hunt" aria-hidden="true"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">订单数</span>
                <span class="info-box-number">{{$order_num}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-md-6">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-product-hunt" aria-hidden="true"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">进货总额</span>
                <span class="info-box-number">{{$order_money}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    
</div>
<div class="row">
    <div class="col-md-12">
        <div id="main_p_1" style="width: auto;height:300px;"></div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div id="main_p_2" style="width: auto;height:400px;"></div>
    </div>
    <div class="col-lg-6">
        <div id="main_p_3" style="width: auto;height:400px;"></div>
    </div>
</div>
<div class="row">
    <caption>采购订单明细</caption>
    <table class="table">

        <thead class="thead-primary">
            <tr>
                <th scope="col">#</th>
                <th scope="col">合同编号</th>
                <th scope="col">供应商</th>
                <th scope="col">金额</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchase_list as $item)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$item->order_no}}</td>
                <td>{{$item->supplier->name}}</td>
                <td>{{$item->total_money}}</td>
            </tr>
            @endforeach
            
        </tbody>
    </table>

</div>
<script src="/static/js/echarts.js"></script>

<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('main_p_1'));
    var myChart1 = echarts.init(document.getElementById('main_p_2'));
    var myChart2 = echarts.init(document.getElementById('main_p_3'));

    // 指定图表的配置项和数据
    option_p_1 = {
        title: {
            text: '进货成本分布'
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },
        legend: {},
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: {
            type: 'value',
            boundaryGap: [0, 0.01]
        },
        yAxis: {
            type: 'category',
            data: {!! $cost_title !!},
        },
        series: [{
            name: '总金额',
            type: 'bar',
            data: {!! $cost_value !!},
        }]
    };
    option_p_2 = {
        title: {
            text: '进货入库统计'
        },
        xAxis: {
            type: 'category',
            data: {!! $store_in_info_title !!},
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            data: {!! $store_in_info_value !!},
            type: 'line',
            smooth: true
        }]
    };

    option_p_3 = {
        title: {
            text: '退货统计'
        },
        xAxis: {
            type: 'category',
            data: {!! $purchase_back_title !!},
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            data: {!! $purchase_back_value !!},
            type: 'bar'
        }]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option_p_1);
    myChart1.setOption(option_p_2);
    myChart2.setOption(option_p_3);
</script>

<script>
    Dcat.ready(function() {
        // js代码也可以放在模板里面
        console.log('所有JS脚本都加载完了!!!');
    });
</script>
