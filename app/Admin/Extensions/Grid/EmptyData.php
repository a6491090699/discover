<?php

/*
 * // +----------------------------------------------------------------------
 * // | erp
 * // +----------------------------------------------------------------------
 * // | Copyright (c) 2006~2020 erp All rights reserved.
 * // +----------------------------------------------------------------------
 * // | Licensed ( LICENSE-1.0.0 )
 * // +----------------------------------------------------------------------
 * // | Author: yy <649109069@qq.com>
 * // +----------------------------------------------------------------------
 */

namespace App\Admin\Extensions\Grid;

use Dcat\Admin\Grid\Displayers\AbstractDisplayer;

class EmptyData extends AbstractDisplayer
{
    public function display()
    {
        return $this->value ?: '-';
    }
}
