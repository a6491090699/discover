<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SellPayLog extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'sell_pay_logs';

    const PAY_TT = 1;
    const PAY_XYZ = 2;
    const PAY_CDHP = 3;
    
    const PAY_METHOD_LIST = [
        self::PAY_TT => 'TT(现汇)',
        self::PAY_XYZ => '信用证',
        self::PAY_CDHP => '承兑汇票',
    ];
    
}
