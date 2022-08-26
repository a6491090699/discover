<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class FrameContract extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    // CONST STATUS_STAT = 1;
    // CONST STATUS_CHECKING = 1;
    // CONST STATUS_CHECKING = 1;

    protected $table = 'frame_contracts';

    
    
}
