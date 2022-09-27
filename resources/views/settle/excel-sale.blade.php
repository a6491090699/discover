<table>
    <caption>销售单列表</caption>
    <thead>

        <tr>
            <th>序号</th>
            <th>客户名称</th>
            <th>销售合同</th>
            <th>销售单位</th>
            <th>销售数目</th>
            <th>销售金额(RMB)</th>
            <th>收款时间</th>
            <th>收款金额(RMB)</th>
            <th>费用类型</th>
            <th>核算时间</th>
            {{-- <th>操作费</th> --}}
            {{-- <th>资金占用费</th> --}}
            {{-- <th>应收金额(RMB)</th> --}}



        </tr>
    </thead>
    <tbody>

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
                    {{-- <td>{{ $log->caozuo }}</td> --}}
                    {{-- <td>{{ $log->zhanyong }}</td> --}}
                    {{-- <td>{{ $log->this_time_money + $log->caozuo + $log->zhanyong }}</td> --}}
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
            {{-- <td></td> --}}
            {{-- <td></td> --}}
            {{-- <td></td> --}}
            {{-- <td></td> --}}
            {{-- <td></td> --}}
            <td>收款总额(RMB)</td>
            <td><span class="badge bg-red">{{ $sale_all }}</span></td>
        </tr>

    </tbody>
</table>
