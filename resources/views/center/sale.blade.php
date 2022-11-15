<div class="alert alert-info" role="alert">销售报表</div>
<div class="row">
    <div class="col-md-6">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-product-hunt" aria-hidden="true"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">合同数</span>
                <span class="info-box-number">{{$sale_order_num}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-md-6">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-product-hunt" aria-hidden="true"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">合同金额</span>
                <span class="info-box-number">{{$sale_order_money}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    
</div>
<div class="row">
    <div class="col-md-12">
        <div id="main_s_1" style="width: auto;height:300px;"></div>
    </div>
</div>
<div class="row">
    <caption>销售订单明细</caption>
    <table class="table">
        
        <thead class="thead-primary">
          <tr>
            <th scope="col">#</th>
            <th scope="col">合同编号</th>
            <th scope="col">客户</th>
            <th scope="col">金额</th>
          </tr>
        </thead>
        <tbody>

          @foreach($sale_order_list as $item)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$item->order_no}}</td>
                <td>{{$item->customer->name}}</td>
                <td>{{$item->total_money}}</td>
            </tr>
            @endforeach
        </tbody>
      </table>
      
      
</div>
<script src="/static/js/echarts.js"></script>

<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('main_s_1'));

    // 指定图表的配置项和数据
    option_s_1 = {
        title: {
            text: '客户贡献金额'
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
            data: {!! $sale_cost_title !!}
        },
        series: [{
            name: '总金额',
            type: 'bar',
            data: {!! $sale_cost_value !!}
        }]
    };
    

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option_s_1);
</script>

<script>
    Dcat.ready(function() {
        // js代码也可以放在模板里面
        console.log('所有JS脚本都加载完了!!!');
    });
</script>
