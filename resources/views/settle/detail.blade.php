<div class="box">
    <div class="box-header">
        <h3 class="box-title">采购清单</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
        <table class="table table-condensed">
            <tbody>
                <tr>
                    <th style="width: 20px">序号</th>
                    <th>供应商名称</th>
                    <th>采购合同</th>
                    <th>采购单位</th>
                    <th>采购数目</th>
                    <th>采购总金额(RMB)</th>
                    <th>付款时间</th>
                    <th>付款金额(RMB)</th>
                    <th>费用类型</th>
                    <th>核算时间</th>
                    <th>操作费</th>
                    <th>资金占用费</th>
                    <th>应付金额(RMB)</th>
                </tr>
                @foreach ($settle['purchase_settle_data'] as $purchase_order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $purchase_order['order']->supplier->name }}</td>
                        <td>{{ $purchase_order['order']->order_no }}</td>
                        <td>KG</td>
                        <td>1</td>
                        <th>{{ $purchase_order['order']->total_money }}</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach ($purchase_order['pay_logs'] as $log)
                        <tr>
                            <td>({{ $loop->iteration }})</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $log->pay_at }}</td>
                            <td>{{ $log->this_time_money }}</td>
                            <td>{{ $log->feeType->title }}</td>
                            <td>{{ $log->check_at }}</td>
                            <td>{{ $log->caozuo }}</td>
                            <td>{{ $log->zhanyong }}</td>
                            <td>{{ $log->this_time_money + $log->caozuo + $log->zhanyong }}</td>
                        </tr>
                    @endforeach
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>应付总额(RMB)</td>
                    <td><span class="badge bg-green">{{$purchase_all}}</span></td>

                </tr>

            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>

<div class="box">
    <div class="box-header">
        <h3 class="box-title">销售清单</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
        <table class="table table-condensed">
            <tbody>
                <tr>
                    <th style="width: 20px">序号</th>
                    <th>客户名称</th>
                    <th>销售合同</th>
                    <th>销售单位</th>
                    <th>销售数目</th>
                    <th>销售金额(RMB)</th>
                    <th>收款时间</th>
                    <th>收款金额(RMB)</th>
                    <th>费用类型</th>
                    <th>核算时间</th>
                    <th>操作费</th>
                    <th>资金占用费</th>
                    <th>应收金额(RMB)</th>
                </tr>
                @foreach ($settle['sale_settle_data'] as $sale_order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $sale_order['order']->customer->name }}</td>
                        <td>{{ $sale_order['order']->order_no }}</td>
                        <td>KG</td>
                        <td>1</td>
                        <th>{{ $sale_order['order']->total_money }}</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach ($sale_order['pay_logs'] as $log)
                        <tr>
                            <td>({{ $loop->iteration }})</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $log->pay_at }}</td>
                            <td>{{ $log->this_time_money }}</td>
                            <td>{{ $log->feeType->title }}</td>
                            <td>{{ $log->check_at }}</td>
                            <td>{{ $log->caozuo }}</td>
                            <td>{{ $log->zhanyong }}</td>
                            <td>{{ $log->this_time_money + $log->caozuo + $log->zhanyong }}</td>
                        </tr>
                    @endforeach
                @endforeach

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>收款总额(RMB)</td>
                    <td><span class="badge bg-red">{{$sale_all}}</span></td>

                </tr>

            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
{{-- 算差价 --}}
<div class="box">
    <div class="box-header">
        <h3 class="box-title">统计</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
        <table class="table table-condensed">
            <tbody>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>项目</th>
                    <th>数值</th>
                    <th style="width: 40px">Label</th>
                </tr>
                <tr>
                    <td>1.</td>
                    <td>利息差</td>
                    <td><span class="badge bg-red">{{ $sale_zhanyong }}</span></td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>应补</td>
                    <td><span class="badge bg-red">{{ $purchase_all - $sale_all - $sale_zhanyong }}</span></td>
                </tr>

            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
