<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CustomerController;
use App\Http\Controllers\Dashboard\EmployeeController;
use App\Http\Controllers\Dashboard\SupplierController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\PaySalaryController;
use App\Http\Controllers\Dashboard\AttendenceController;
use App\Http\Controllers\Dashboard\AdvanceSalaryController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\PosController;
use App\Http\Controllers\Dashboard\RoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
    Route::resource('/customers', CustomerController::class);
    Route::resource('/suppliers', SupplierController::class);
    Route::resource('/employees', EmployeeController::class);
    Route::resource('/advance-salary', AdvanceSalaryController::class)->except(['show']);

    // PaySalary
    Route::resource('/pay-salary', PaySalaryController::class)->except(['show', 'create', 'edit', 'update']);
    Route::get('/pay-salary/history', [PaySalaryController::class, 'payHistory'])->name('pay-salary.payHistory');
    Route::get('/pay-salary/history/{id}', [PaySalaryController::class, 'payHistoryDetail'])->name('pay-salary.payHistoryDetail');
    Route::get('/pay-salary/{id}', [PaySalaryController::class, 'paySalary'])->name('pay-salary.paySalary');

    // Employee Attendence
    Route::resource('/employee/attendence', AttendenceController::class)->except(['show', 'update', 'destroy']);

    // Products
    Route::get('/products/import', [ProductController::class, 'importView'])->name('products.importView');
    Route::post('/products/import', [ProductController::class, 'importStore'])->name('products.importStore');
    Route::get('/products/export', [ProductController::class, 'exportData'])->name('products.exportData');
    Route::resource('/products', ProductController::class);
    Route::resource('/categories', CategoryController::class);

    // POS
    Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
    Route::post('/pos/add-cart', [PosController::class, 'addCart'])->name('pos.addCart');
    Route::post('/pos/update-cart/{rowId}', [PosController::class, 'updateCart'])->name('pos.updateCart');
    Route::get('/pos/delete-cart/{rowId}', [PosController::class, 'deleteCart'])->name('pos.deleteCart');
    Route::get('/pos/all-item', [PosController::class, 'allItem'])->name('pos.allItem');
    Route::post('/pos/create-invoice', [PosController::class, 'createInvoice'])->name('pos.createInvoice');
    Route::post('/pos/print-invoice', [PosController::class, 'printInvoice'])->name('pos.printInvoice');

    // Create Order
    Route::post('/pos/order', [OrderController::class, 'orderStore'])->name('pos.orderStore');
    Route::get('/orders/pending', [OrderController::class, 'pendingOrders'])->name('order.pendingOrders');
    Route::get('/orders/complete', [OrderController::class, 'completeOrders'])->name('order.completeOrders');
    Route::get('/orders/details/{order_id}', [OrderController::class, 'orderDetails'])->name('order.orderDetails');
    Route::put('/orders/update/status', [OrderController::class, 'updateStatus'])->name('order.updateStatus');
    Route::get('/order/invoice-download/{order_id}', [OrderController::class, 'invoiceDownload'])->name('order.invoiceDownload');

    // Stock Management
    Route::get('/stock', [OrderController::class, 'stockManage'])->name('order.stockManage');
});

Route::controller(RoleController::class)->middleware('auth')->group(function () {
    // Permissions
    Route::get('/permission', 'permissionIndex')->name('permission.index');
    Route::get('/permission/create', 'permissionCreate')->name('permission.create');
    Route::post('/permission', 'permissionStore')->name('permission.store');
    Route::get('/permission/edit/{id}', 'permissionEdit')->name('permission.edit');
    Route::put('/permission/{id}', 'permissionUpdate')->name('permission.update');
    Route::delete('/permission/{id}', 'permissionDestroy')->name('permission.destroy');

    // Roles
    Route::get('/role', 'roleIndex')->name('role.index');
    Route::get('/role/create', 'roleCreate')->name('role.create');
    Route::post('/role', 'roleStore')->name('role.store');
    Route::get('/role/edit/{id}', 'roleEdit')->name('role.edit');
    Route::put('/role/{id}', 'roleUpdate')->name('role.update');
    Route::delete('/role/{id}', 'roleDestroy')->name('role.destroy');

    // Role Permissions
    Route::get('/role/permission/create', 'rolePermissionCreate')->name('rolePermission.create');
    Route::post('/role/permission', 'rolePermissionStore')->name('rolePermission.store');

    // Route::get('/role/permission', 'rolePermissionIndex')->name('rolePermission.index');
    // Route::get('/role/permission/create', 'rolePermissionCreate')->name('rolePermission.create');
    // Route::post('/role/permission', 'rolePermissionStore')->name('rolePermission.store');
    // Route::get('/role/permission/{id}', 'rolePermissionEdit')->name('rolePermission.edit');
    // Route::put('/role/permission/{id}', 'rolePermissionUpdate')->name('rolePermission.update');
    // Route::delete('/role/permission/{id}', 'rolePermissionDestroy')->name('rolePermission.destroy');
});

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
});

require __DIR__.'/auth.php';
