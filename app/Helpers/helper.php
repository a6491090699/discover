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

use App\Models\AttrValueModel;
use App\Models\BaseModel;
use App\Models\OrderNoGeneratorModel;
use App\Models\PurchaseOrderModel;
use Illuminate\Support\Facades\Redis;

if (!file_exists("lower_pinyin_abbr")) {
    /**
     * @param string $str
     *
     * @return string
     */
    function up_pinyin_abbr(string $str): string
    {
        return strtoupper(pinyin_abbr($str));
    }
}

if (!function_exists('build_order_no')) {
    /**
     * @param string $prefix
     * @return string
     */
    function build_order_no(string $prefix = ''): string
    {
        $prefix = strtoupper($prefix);
        
        $redis_key = 'sn_autoincrement_'.$prefix;
        if (Redis::exists($redis_key)) {
            $auto = Redis::get($redis_key);
        } else {
            Redis::set($redis_key, 1);
            $auto = '1';
        }
        if (strlen($auto) < 6) {
            $auto = str_repeat('0', 6 - strlen($auto)) . $auto;
        }

    // return uniqid($prefix);
    return $prefix . date('ymd') . $auto;
    }
    // function build_order_no(string $prefix = ''): string
    // {
    //     $date = date("Ymd");
    //     $number = OrderNoGeneratorModel::query()->where([
    //         'prefix' => $prefix,
    //         'happen_date' => $date
    //     ])->value('number');

    //     return $prefix . $date . str_pad($number + 1, "4", "0", STR_PAD_LEFT);
    // }
}
if (!function_exists('crossJoin')) {
    /**
     * @param $arrays
     * @return array
     */
    function crossJoin($arrays)
    {
        $results = [[]];

        foreach ($arrays as $index => $array) {
            $append = [];

            foreach ($results as $product) {
                foreach ($array as $item) {
                    $product[$index] = $item;

                    $append[] = $product;
                }
            }

            $results = $append;
        }

        return $results;
    }
}

if (!function_exists('attrCrossJoin')) {
    function attrCrossJoin($arrays)
    {
        $result = [];
        $attr_values = AttrValueModel::getAttrValues();
        array_map(function (array $value) use (&$result, $attr_values) {
            $key          = implode(',', $value);
            $str          = $attr_values->only($value);
            $result[$key] = $str;
        }, crossJoin($arrays));
        return $result;
    }
}
if (!function_exists('show_order_review')) {
    function show_order_review(int $review_status): int
    {
        if (in_array($review_status, [BaseModel::REVIEW_STATUS_WAIT, BaseModel::REVIEW_STATUS_REREVIEW])) {
            return BaseModel::REVIEW_STATUS_OK;
        }
        return BaseModel::REVIEW_STATUS_REREVIEW;
    }
}

if (!file_exists("store_order_img")) {
    /**
     * @param int $status
     *
     * @return string
     */
    function store_order_img(string $status): string
    {
        $img = "";
        switch ($status) {
            case BaseModel::REVIEW_STATUS_WAIT:
                $img = asset("static/images/stamp_0002.png");
                break;
            case BaseModel::REVIEW_STATUS_OK:
                $img = asset("static/images/stamp_0003.png");
                break;
            case BaseModel::REVIEW_STATUS_REREVIEW:
                $img = asset("static/images/stamp_0004.png");
                break;
        }
        return $img;
    }
}

function create_uniqid_sn($type = '')
{
    $prefix = '';
    switch ($type) {
        case 'customer':
            $prefix = 'KH';
            break;
        case 'provider':
            $prefix = 'FWS';
            break;
        case 'supplier':
            $prefix = 'GYS';
            break;
        case 'store':
            $prefix = 'CK';
            break;
        case 'frame_contract':
            $prefix = 'FR';
            break;
        case 'purchase_back':
            $prefix = 'PB';
            break;
        default:
            $prefix = 'Q';
            break;
    }
    $redis_key = 'sn_autoincrement_'.$prefix;
    if (Redis::exists($redis_key)) {
        $auto = Redis::get($redis_key);
    } else {
        Redis::set($redis_key, 1);
        $auto = '1';
    }
    if (strlen($auto) < 6) {
        $auto = str_repeat('0', 6 - strlen($auto)) . $auto;
    }

    // return uniqid($prefix);
    return $prefix . date('ymd') . $auto;
}

function increment_uniqid_sn($type)
{
    $prefix = '';
    switch ($type) {
        case 'customer':
            $prefix = 'KH';
            
            break;
        case 'provider':
            $prefix = 'FWS';
            break;
        case 'supplier':
            $prefix = 'GYS';
            break;
        case 'store':
            $prefix = 'CK';
            break;
        case 'frame_contract':
            $prefix = 'FR';
            break;
        default:
            $prefix = 'Q';
            break;
    }
    $redis_key = 'sn_autoincrement_'.$prefix;
    if (Redis::exists($redis_key)) {
        Redis::incr($redis_key);
    }
    return true;
}




function create_order_sn($type, $short_title, $sign_at)
{
    // $redis_key = 'order_sn_autoincrement';
    // if (Redis::exists($redis_key)) {
    //     $auto = Redis::incr($redis_key);
    // } else {
    //     Redis::set($redis_key, 1);
    //     $auto = '1';
    // }
    // if (strlen($auto) < 6) {
    //     $auto = str_repeat('0', 6 - strlen($auto)) . $auto;
    // }

    // $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    // $wind = PurchaseOrderModel::where('sign_at' , $sign_at)->where('supplier_id',$supplier_id)->count();
    // $auto = substr($str , $wind , 1);
    $date_str = date('ymdHis', strtotime($sign_at));
    switch ($type) {
        case 'buy':
            $first = "B-" . up_pinyin_abbr($short_title) . '-' . $date_str ;
            break;
        case 'sell':
            $first = "S-" . up_pinyin_abbr($short_title) . '-' . $date_str ;
            break;
        default:
            $first = "O-" . up_pinyin_abbr($short_title) . '-' . $date_str ;
            break;
    }
    return $first;
}
