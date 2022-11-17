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

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {
    $router->get('/', 'HomeController@index');
    $router->get('test', 'HomeController@test');
    $router->get('api/get-attr-value', 'ApiController@getAttrValue')->name('api.attrvalue.find');
    $router->get('api/get-product-unit', 'ApiController@getUnitByProductId')->name('api.productunit.find');
    $router->get('api/get-product', 'ApiController@getProductInfo')->name('api.product.find');
    $router->post('api/with/order', 'ApiController@withOrder')->name('api.with.order');
    $router->get('api/get-customer-address', 'ApiController@getCustomerAddress')->name('api.customer.address.find');
    $router->get('api/get-customer-drawee', 'ApiController@getCustomerDrawee')->name('api.customer.drawee.find');

    $router->any('approvals/check/{id}', 'ApprovalController@checkInfo')->name('approval.checkInfo');
    // $router->post('approvals/check' , 'ApprovalController@check')->name('approval.check');
    $router->put('approvals/check', 'ApprovalController@check')->name('approval.check');
    $router->resource('approvals', 'ApprovalController');

    $router->resource('sale_back_orders', 'SaleBackOrderController');
    $router->resource('flows', 'FlowController');
    $router->resource('templates', 'TemplateController');
    $router->resource('messages', 'MessageController');
    $router->resource('invoices', 'InvoiceController');
    $router->resource('fee_types', 'FeeTypeController');
    $router->resource('sell_pay_logs', 'SellPayLogController');
    $router->resource('buy_pay_logs', 'BuyPayLogController');
    $router->resource('deliveries', 'DeliveryController');
    $router->resource('store_outs', 'StoreOutController');
    $router->resource('store_ins', 'StoreInController');
    $router->resource('purchase_order_backs', 'PurchaseOrderBackController');
    $router->resource('frame_contracts', 'FrameContractController');
    $router->resource('store_companies', 'StoreCompanyController');
    $router->resource('stores', 'StoreController');
    $router->resource('product_categories', 'ProductCategoryController');
    $router->resource('providers', 'ProviderController');
    $router->resource('companies', 'CompanyController');
    $router->resource('departments', 'DepartmentController');
    $router->resource('attrs', 'AttrController');
    $router->resource('products', 'ProductController');
    $router->resource('units', 'UnitController');
    $router->resource('purchase-orders', 'PurchaseOrderController');
    $router->resource('purchase-items', 'PurchaseItemController');
    $router->resource('suppliers', 'SupplierController');
    $router->resource('purchase-in-orders', 'PurchaseInOrderController');
    $router->resource('purchase-in-items', 'PurchaseInItemController');
    $router->resource('positions', 'PositionController');
    $router->resource('sku-stocks', 'SkuStockController');
    $router->resource('sku-stock-batchs', 'SkuStockBatchController');
    $router->resource('stock-historys', 'StockHistoryController');
    $router->resource('sale-orders', 'SaleOrderController');
    $router->resource('sale-items', 'SaleItemController');
    $router->resource('sale-in-orders', 'SaleInOrderController');
    $router->resource('sale-out-orders', 'SaleOutOrderController');
    $router->resource('sale-out-items', 'SaleOutItemController');
    $router->resource('customers', 'CustomerController');
    $router->resource('sale-out-batchs', 'SaleOutBatchController');
    $router->resource('drawees', 'DraweeController');
    $router->resource('tasks', 'TaskController');
    $router->resource('crafts', 'CraftController');
    $router->resource('apply-for-orders', 'ApplyForOrderController');
    $router->resource('apply-for-items', 'ApplyForItemController');
    $router->resource('apply-for-batchs', 'ApplyForBatchController');
    $router->resource('make-product-orders', 'MakeProductOrderController');
    $router->resource('make-product-items', 'MakeProductItemController');
    $router->resource('inventory-orders', 'InventoryOrderController');
    $router->resource('inventory-items', 'InventoryItemController');
    $router->resource('init-stock-orders', 'InitStockOrderController');
    $router->resource('init-stock-items', 'InitStockItemController');
    $router->get('order-prints', 'PrintController@print')->name('order.print');
    $router->get('prints-approval/{id}', 'PrintController@approvalPrint')->name('order.approvalPrint');
    $router->get('prints-contract/{id}', 'PrintController@contractPrint')->name('order.contractPrint');
    $router->get('preview/{id}', 'PrintController@preview')->name('template.preview');
    $router->get('prints-test', 'PrintController@test');


    $router->resource('accountant-dates', "AccountantDateController");
    $router->resource('accountant-date-items', "AccountantDateItemController");
    $router->resource('purchase-order-amounts', 'PurchaseOrderAmountController');
    $router->resource('month-settlements', 'MonthSettlementController');
    $router->resource('cost-orders', 'CostOrderController');
    $router->resource('cost-items', 'CostItemController');
    $router->post('month-settlements/settlement', 'MonthSettlementController@settlement')->name('month-settlements.settlement');
    $router->resource('statement-orders', 'StatementOrderController');
    $router->resource('statement-items', 'StatementItemController');

    $router->resource('demands', 'DemandController');
    $router->resource('inventorys', "InventoryController");
    $router->resource('checkout-products', 'CheckProductController');

    $router->get('report-centers', 'ReportCenterController@index');
    $router->get('settle-data/{id}', 'FinancialReportController@settleData')->name('financial.settle-data');
    $router->get('settlement-history', 'FinancialReportController@settlementHistory')->name('financial.settlement-history');
    $router->get('unsettled-cost', 'FinancialReportController@unsettledCost')->name('financial.unsettled-cost');
    $router->get('cost-order-statistical', 'FinancialReportController@costOrderStatistical')->name('financial.cost-order-statistical');

    $router->get('purchase-report/order-amount', 'PurchaseInReportController@orderAmount')->name('purchase-report.order-amount');
    $router->get('purchase-report/items', 'PurchaseInReportController@items')->name('purchase-report.items');
    $router->get('purchase-report/summary-by-supplier', 'PurchaseInReportController@summaryBySupplier')->name('purchase-report.summary-by-supplier');
    $router->get('purchase-report/summary-by-sku', 'PurchaseInReportController@summaryBySku')->name('purchase-report.summary-by-sku');

    $router->get('sale-report/order-amount', 'SaleOutReportController@orderAmount')->name('sale-report.order-amount');
    $router->get('sale-report/items', 'SaleOutReportController@items')->name('sale-report.items');
    $router->get('sale-report/summary-by-customer', 'SaleOutReportController@summaryByCustomer')->name('sale-report.summary-by-customer');
    $router->get('sale-report/summary-by-sku', 'SaleOutReportController@summaryBySku')->name('sale-report.summary-by-sku');

    $router->get('make-product-report/apply-for-items', 'MakeProductReportController@applyForItems')->name('make-product-report.apply-for-items');
    $router->get('make-product-report/apply-for-summary', 'MakeProductReportController@applyForSummary')->name('make-product-report.apply-for-summary');

    $router->get('make-product-report/items', 'MakeProductReportController@items')->name('make-product-report.items');
    $router->get('make-product-report/summary', 'MakeProductReportController@summary')->name('make-product-report.summary');
});
