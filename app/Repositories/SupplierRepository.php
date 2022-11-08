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

namespace App\Repositories;

use App\Models\SupplierModel;
use Illuminate\Support\Collection;
use Yxx\LaravelQuick\Repositories\BaseRepository;

class SupplierRepository extends BaseRepository
{
    /**
     * @return Collection
     */
    public static function pluck(): Collection
    {
        return SupplierModel::orderBy('id', 'desc')->pluck('name', 'id');
    }
}
