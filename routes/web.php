<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SaleOrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\UploadProductController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class,'index'])->middleware(['auth'])->name('dashboard');
Route::prefix('dashboard')->middleware(['auth'])->group(function(){
    Route::get('sales/chart', [DashboardController::class,'saleOrderChart'])->name('dashboard.sales.chart');
    Route::get('expenses/chart', [DashboardController::class,'expensesChart'])->name('dashboard.expenses.chart');
});
Route::prefix('product')->middleware(['auth','can:products.view'])->group(function(){
    Route::get('',[ProductController::class,'index'])->name('product.index');
    Route::get('add',[ProductController::class,'add'])->middleware(['can:products.add'])->name('product.add');
    Route::get('edit/{product}', [ProductController::class, 'edit'])->middleware(['can:products.edit'])->name('product.edit');
    Route::post('',[ProductController::class,'store'])->middleware(['can:products.add'])->name('product.store');
    Route::post('product/images', [ProductController::class,'imageUpload'])->middleware(['can:products.add'])->name('product.images');
    Route::post('update/{product}', [ProductController::class, 'update'])->middleware(['can:products.edit'])->name('product.update');
    Route::post('upload', UploadProductController::class)->middleware(['can:products.add'])->name('upload.products');
    Route::delete('product/images', [ProductController::class, 'deleteImage'])->middleware(['can:products.delete'])->name('product.image-delete');
    Route::delete('delete/{product}', [ProductController::class, 'destroy'])->middleware(['can:products.delete'])->name('product.destroy');
});
Route::prefix('vendor')->middleware(['auth','can:vendors.view'])->group(function (){
    Route::get('', [VendorController::class,'index'])->name('vendor.index');
    Route::get('add', [VendorController::class,'add'])->middleware(['can:vendors.add'])->name('vendor.add');
    Route::get('edit/{vendor}', [VendorController::class,'edit'])->middleware(['can:vendors.edit'])->name('vendor.edit');
    Route::post('', [VendorController::class,'store'])->middleware(['can:vendors.add'])->name('vendor.store');
    Route::put('update/{vendor}', [VendorController::class,'update'])->middleware(['can:vendors.edit'])->name('vendor.update');
    Route::delete('delete/{vendor}', [VendorController::class,'destroy'])->middleware(['can:vendors.delete'])->name('vendor.destroy');
});
Route::prefix('purchaseOrder')->middleware(['auth','can:orders.view'])->group(function (){
    Route::get('',[PurchaseOrderController::class,'index'])->name('purchase-order.index');
    Route::get('add', [PurchaseOrderController::class,'add'])->name('purchase-order.add');
    Route::get('vendor/{vendor}/{order}', [PurchaseOrderController::class, 'ajaxVendor'])->name('ajax.vendor');
    Route::get('product/{category}', AjaxProductController::class)->name('ajax.product');
    Route::get('edit/{order}', [PurchaseOrderController::class, 'edit'])->name('purchase-order.edit');
    Route::post('', [PurchaseOrderController::class, 'store'])->name('purchase-order.store');
    Route::put('submit/{order}', [PurchaseOrderController::class, 'submitOrder'])->name('purchase-order.approve');
});
Route::prefix('customer')->middleware(['auth','can:customers.view'])->group(function (){
    Route::get('',[CustomerController::class,'index'])->name('customer.index');
    Route::get('add',[CustomerController::class,'add'])->middleware(['can:customers.add'])->name('customer.add');
    Route::get('edit/{customer}', [CustomerController::class, 'edit'])->middleware(['can:customers.edit'])->name('customer.edit');
    Route::post('', [CustomerController::class,'store'])->middleware(['can:customers.add'])->name('customer.store');
    Route::put('update/{customer}', [CustomerController::class,'update'])->middleware(['can:customers.edit'])->name('customer.update');
    Route::delete('delete/{customer}', [CustomerController::class,'destroy'])->middleware(['can:customers.delete'])->name('customer.destroy');
});
Route::prefix('saleOrder')->middleware(['auth','can:orders.view'])->group(function (){
    Route::get('', [SaleOrderController::class,'index'])->name('sale-order.index');
    Route::get('add', [SaleOrderController::class,'add'])->name('sale-order.add');
    Route::get('edit/{order}', [SaleOrderController::class, 'edit'])->name('sale-order.edit');
    Route::get('customer/{customer}/{order}', [SaleOrderController::class, 'ajaxCustomer'])->name('ajax.customer');
    Route::get('product/{category}', AjaxProductController::class)->name('ajax.product');
    Route::post('', [SaleOrderController::class, 'store'])->name('sale-order.store');
    Route::put('payment/{order}', [SaleOrderController::class, 'orderPayment'])->name('sale-order.payment');
});
Route::prefix('report')->middleware(['auth'])->group(function (){
    Route::prefix('saleOrder')->group(function () {
        Route::get('',[ReportController::class,'saleOrder'])->name('report.saleOrder');
        Route::get('ajax',[ReportController::class,'saleOrderAjax'])->name('sales.ajax');
        Route::get('chart/{start}/{end}', [ReportController::class, 'saleOrderChart'])->name('sales.chart');
    });
    Route::get('/summarized',[ReportController::class,'summarized'])->name('report.summarized');
    Route::get('/purchaseOrder',[ReportController::class,'purchaseOrder'])->name('report.purchaseOrder');

    Route::get('/bestSelling',[ReportController::class,'bestSelling'])->name('report.bestSelling');
    Route::get('/expenses',[ReportController::class,'expenses'])->name('report.expenses');
    Route::get('/expenses/chart/{start}/{end}',[ReportController::class,'expensesChartAjax'])->name('report.chart');
});
Route::prefix('settings')->middleware(['auth'])->group(function (){
    Route::prefix('store')->middleware(['can:other.change_settings'])->group(function (){
        Route::get('',[StoreController::class,'index'])->name('store.index');
        Route::get('edit/{store}', [StoreController::class, 'edit'])->name('store.edit');
        Route::post('add', [StoreController::class, 'store'])->name('store.add');
        Route::post('assignSeller/{store}', [StoreController::class, 'assignSeller'])->name('store.seller');
        Route::put('update', [StoreController::class, 'update'])->name('store.update');
        Route::delete('destroy/{store}', [StoreController::class, 'destroy'])->name('store.destroy');
    });
    Route::prefix('product_category')->middleware(['can:other.change_settings'])->group(function (){
        Route::get('', [CategoryController::class, 'index'])->name('category.index');
        Route::get('edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('add', [CategoryController::class, 'store'])->name('category.add');
        Route::put('update', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('destroy/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });
    Route::prefix('users')->middleware(['can:users.view'])->group(function (){
        Route::get('',[UserController::class,'index'])->name('users.index');
        Route::get('edit/{user}', [UserController::class, 'edit'])->middleware(['can:users.edit'])->name('users.edit');
        Route::post('', [UserController::class, 'store'])->middleware(['can:users.add'])->name('users.store');
        Route::post('assign/{user}', [UserController::class, 'assignStore'])->middleware(['can:users.edit'])->name('users.shop');
        Route::put('update', [UserController::class, 'update'])->middleware(['can:users.edit'])->name('users.update');
        Route::delete('destroy/{user}', [UserController::class, 'destroy'])->middleware(['can:users.delete'])->name('user.destroy');

    });
    Route::prefix('profile')->group(function (){
        Route::get('',[UserController::class,'profile'])->name('users.profile');
        Route::post('changePassword/{user}', [UserController::class, 'changePassword'])->name('user.change-password');
    });
    Route::prefix('roles')->middleware(['can:other.change_settings'])->group(function (){
        Route::get('',[RolePermissionController::class,'index'])->name('role.index');
        Route::post('', [RolePermissionController::class, 'store'])->name('role.store');
    });
    Route::prefix('permissions')->middleware(['can:other.change_settings'])->group(function (){
        Route::get('{role}', [RolePermissionController::class, 'permissionRole'])->name('permission.role');
        Route::post('{role}', [RolePermissionController::class, 'givePermission'])->name('permission.async');
    });
    Route::get('/logs', [ActivityLogController::class,'index'])->middleware(['can:other.change_settings'])->name('logs.index');
});
Route::prefix('device')->group(function(){
    Route::get('', [DeviceController::class, 'index']);
    Route::get('card', [DeviceController::class, 'fetchCard']);
    Route::get('cardTapped', [DeviceController::class, 'getCard']);
});

require __DIR__.'/auth.php';
