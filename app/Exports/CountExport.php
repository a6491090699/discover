<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;

class CountExport implements FromCollection, ShouldAutoSize, WithHeadings, WithTitle
{
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    // public function view(): View
    // {
    //     return view('settle.excel-count', ['settle' => $this->data]);
    // }

    /**
     * @return string
     */
    public function title(): string
    {
        return '总费用';
    }

    public function headings(): array
    {
        return [
            '#',
            '金额',
            '备注',
        ];
    }

    public function collection()
    {

        extract($this->data);
        $huokuan = 0;
        $huokuan_zhanyong = 0;
        $third = 0;
        $third_zhanyong = 0;

        foreach ($settle['purchase_settle_data'] as $item) {
            $item['pay_logs']->map(function ($i) use (&$huokuan, &$huokuan_zhanyong, &$third, &$third_zhanyong) {
                if (!in_array($i->fee_type_id, [1, 9, 10])) {
                    $third += $i->this_time_money;
                    $third_zhanyong += $i->zhanyong;
                }
                if ($i->fee_type_id == 1) {
                    //货款
                    $huokuan_zhanyong += $i->zhanyong;
                    $huokuan += $i->this_time_money;
                }
            });
        }
        return new Collection([
            ['货款金额', $huokuan, ''],
            ['货款操作费', $huokuan * $frame_contract->caozuo_rate, ''],
            ['货款资金占用费', $huokuan_zhanyong, ''],
            ['第三方费用', $third, '减去定金 货款 剩余的所有费用'],
            ['第三方费用资金占用费', $third_zhanyong, ''],
            ['应收款总额', $purchase_all, ''],
            ['已付货款及抵扣费用', $sale_all + $sale_zhanyong, '收款费用+收款的费用到核算日产生的利息'],
            ['当前欠款', $purchase_all - $sale_all - $sale_zhanyong, ''],
        ]);
    }
}
