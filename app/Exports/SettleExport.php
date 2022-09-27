<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SettleExport implements WithMultipleSheets,ShouldAutoSize
{
    use Exportable;

    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new PurchaseExport($this->data);
        $sheets[] = new SaleExport($this->data);
        $sheets[] = new CountExport($this->data);
        return $sheets;
    }
}
