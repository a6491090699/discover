<table>
    <caption>采购单列表</caption>
    <thead>

        <tr>
            <th>序号</th>
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
            <th>备注</th>



        </tr>
    </thead>
    <tbody>

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
            <td><span class="badge bg-green">{{ $purchase_all }}</span></td>

        </tr>

    </tbody>
</table>
