<?php

use App\Http\Controllers\Auth\EmployeeLoginController;
use App\Http\Controllers\DashboardController;
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
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SalesReturnController;
use App\Http\Controllers\StockAdjustmentController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.employee-login');
});

//Route::get('/login', [EmployeeLoginController::class, 'showLoginForm'])->name('employee.login.form');
//Route::post('/login', [EmployeeLoginController::class, 'login'])->name('employee.login');
//Route::post('/logout', [EmployeeLoginController::class, 'logout'])->name('employee.logout');
 Auth::routes();
Route::middleware(['auth:employee'])->group(function () {
//    Route::get('/home', fn() => view('home'))->name('home');


    Route::get('/invoices/{invoice}/print', [InvoiceController::class, 'print'])->name('invoices.print');

//    Auth::routes();
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
});
Route::middleware(['auth:employee'])->group(function () {
    Route::get('/dashboard', function () {
        $employee = Auth::guard('employee')->user();

        if ($employee->user_type === 'admin' || $employee->department_id == 1) {
            return redirect()->route('dashboard.admin');
        }

        if ($employee->department_id == 2) {
            return redirect()->route('dashboard.clothes');
        }

        if ($employee->department_id == 3) {
            return redirect()->route('dashboard.shoes');
        }

        return abort(403, 'غير مصرح لك بالوصول.');
    })->name('dashboard');

    // لوحات الأقسام
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
    Route::get('/dashboard/clothes', [DashboardController::class, 'clothes'])->name('dashboard.clothes');
    Route::get('/dashboard/shoes', [DashboardController::class, 'shoes'])->name('dashboard.shoes');




    Route::get('/admin/roles-permissions', [RolePermissionController::class, 'index'])->name('admin.roles_permissions.index');
    Route::post('/admin/permissions', [RolePermissionController::class, 'storePermission'])->name('admin.permissions.store');
    Route::post('/admin/roles', [RolePermissionController::class, 'storeRole'])->name('admin.roles.store');
    Route::post('/admin/roles-permissions', [RolePermissionController::class, 'updateRolePermissions'])->name('admin.roles_permissions.update');
    Route::post('/admin/assign-role', [RolePermissionController::class, 'assignRoleToEmployee'])->name('admin.assign_role');
    Route::delete('/admin/permissions/{id}', [RolePermissionController::class, 'destroyPermission'])->name('admin.permissions.destroy');

    Route::delete('/admin/roles/{id}', [RolePermissionController::class, 'destroyRole'])->name('admin.roles.destroy');
});

