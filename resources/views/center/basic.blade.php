<div class="alert alert-info" role="alert">基础数据</div>
<div class="row">
    <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-product-hunt" aria-hidden="true"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">产品数</span>
              <span class="info-box-number">{{$sku_total}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
    </div>
    <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-user-secret" aria-hidden="true"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">供应商数</span>
              <span class="info-box-number">{{$supplier_total}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
    </div>
    <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users" aria-hidden="true"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">合作客户数</span>
              <span class="info-box-number">{{$customer_total}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div id="main" style="width: auto;height:400px;"></div>
    </div>
    <div class="col-lg-6">
        <div id="main2" style="width: auto;height:400px;"></div>
    </div>
</div>
<script src="/static/js/echarts.js"></script>

<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('main'));
    var myChart2 = echarts.init(document.getElementById('main2'));
    console.info({!! $sku_title !!})
    // 指定图表的配置项和数据
    
    option = {
        title: {
            text: '产品分布'
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
            data: {!! $sku_title !!}
        },
        series: [{
            name: '数量',
            type: 'bar',
            data: {!! $sku_num !!}
        }]
    };

    option2 = {
        title: {
            text: '仓库分布'
        },
        tooltip: {
            trigger: 'item'
        },
        legend: {
            top: '5%',
            left: 'center'
        },
        series: [{
            name: 'Access From',
            type: 'pie',
            radius: ['40%', '70%'],
            avoidLabelOverlap: false,
            label: {
                show: false,
                position: 'center'
            },
            emphasis: {
                label: {
                    show: true,
                    fontSize: '40',
                    fontWeight: 'bold'
                }
            },
            labelLine: {
                show: false
            },
            data: {!! $store_info !!}
        }]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
    myChart2.setOption(option2);
</script>

<script>
    Dcat.ready(function() {
        // js代码也可以放在模板里面
        console.log('所有JS脚本都加载完了!!!');
    });
</script>
