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

return [
    'labels' => [
        'PurchaseInOrder' => '采购入库单',
    ],

    'fields' => [
        'order_no' => '订单单号',
        'created_at' => '业务日期',
        'status_str' => '单据状态',
        'with_order.order_no' => "相关单据",
        'supplier.name' => '供应商',
        'other' => '备注',
    ],
    'options' => [],
];
