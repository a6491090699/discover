<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class PurchaseExport implements FromView, ShouldAutoSize, WithTitle
{
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('settle.excel-purchase', $this->data);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return '采购单列表';
    }
}