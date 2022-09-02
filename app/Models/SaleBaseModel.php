<?php

/*
 * // +----------------------------------------------------------------------
 * // | erp
 * // +----------------------------------------------------------------------
 * // | Copyright (c) 2006~2020 erp All rights reserved.
 * // +----------------------------------------------------------------------
 * // | Licensed ( LICENSE-1.0.0 )
 * // +----------------------------------------------------------------------
 * // | Author: yxx <1365831278@qq.com>
 * // +----------------------------------------------------------------------
 */

namespace App\Models;

/**
 * App\Models\SaleBaseModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|SaleBaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleBaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleBaseModel query()
 * @mixin \Eloquent
 */
class SaleBaseModel extends BaseModel
{
    const STATUS_DOING = 0;
    const STATUS_SEND = 1;
    const STATUS_SIGN = 2;
    const STATUS_RETURNED = 3;

    const STATUS = [
        self::STATUS_DOING    => '受理中',
        self::STATUS_SEND     => '已发货',
        self::STATUS_SIGN     => '已签收',
        self::STATUS_RETURNED => '已退回',
    ];

    const STATUS_COLOR = [
        self::STATUS_DOING    => 'gray',
        self::STATUS_SEND     => 'success',
        self::STATUS_SIGN     => 'yellow',
        self::STATUS_RETURNED => 'success',
    ];

    const PAY_TT = 1;
    const PAY_XYZ = 2;
    const PAY_CDHP = 3;

    const PAY_METHOD_LIST = [
        self::PAY_TT => 'TT(现汇)',
        self::PAY_XYZ => '信用证',
        self::PAY_CDHP => '承兑汇票',
    ];

    const TYPE_CHUKOU = 1;
    const TYPE_NEIMAO = 2;
    const TYPE_LIST = [
        self::TYPE_CHUKOU =>'出口',
        self::TYPE_NEIMAO =>'内贸',
    ];
}
