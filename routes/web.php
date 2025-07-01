<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeAdvancePaymentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeSalaryController;
use App\Http\Controllers\InventoryLogController;
use App\Http\Controllers\InventoryReportController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseReturnController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SalesReturnController;
use App\Http\Controllers\StockAdjustmentController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/invoice', function () {
    return view('pages.add_invoice');
});
Route::get('/product', function () {
    return view('pages.products.add_product');
});
Route::get('/products/search', function () {
    return view('pages.add_invoice_module');
});



Route::get('/invoices/{invoice}/print', [InvoiceController::class, 'print'])->name('invoices.print');

Auth::routes();
Route::resource('employees', EmployeeController::class);
Route::resource('departments', DepartmentController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('products', ProductController::class);
Route::resource('purchases', PurchaseController::class);
Route::resource('sales', SaleController::class);
Route::resource('employee-salaries', EmployeeSalaryController::class);
Route::resource('inventory-logs', InventoryLogController::class)->only(['index', 'create', 'store']);
Route::resource('employee-advance-payments', EmployeeAdvancePaymentController::class);
Route::resource('invoices', InvoiceController::class);
Route::resource('payments', PaymentController::class);
Route::resource('stock-adjustments', StockAdjustmentController::class)->only(['index', 'create', 'store']);
Route::resource('sales-returns', SalesReturnController::class)->only(['index', 'create', 'store']);
Route::resource('purchase-returns', PurchaseReturnController::class)->only(['index', 'create', 'store']);
Route::get('/inventory-reports', [InventoryReportController::class, 'index'])->name('inventory-reports.index');
Route::get('/inventory-logs/report/{type}', [InventoryLogController::class, 'report'])->name('inventory-logs.report');
Route::get('/inventory-logs/pdf/{type}', [InventoryLogController::class, 'exportPdf'])->name('inventory-logs.pdf');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
