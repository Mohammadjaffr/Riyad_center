<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Product_variant;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Department;
use App\Models\SaleItem;
use App\Models\PurchaseItem;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function admin()
    {
        $user = Auth::guard('employee')->user();
        $user_type = $user->user_type ?? 'employee';
        $department_id = $user->department_id;

        if ($department_id === 1) {
            $employeesByDepartment = Employee::select('department_id', DB::raw('count(*) as total'))
                ->groupBy('department_id')
                ->with('department')
                ->get();
        } else {
            $employeesByDepartment = Employee::select('department_id', DB::raw('count(*) as total'))
                ->where('department_id', $department_id)
                ->groupBy('department_id')
                ->with('department')
                ->get();
        }

        $totalEmployees = $employeesByDepartment->sum('total');

        // عدد القطع المباعة (مجموع كميات المبيعات + الفواتير)
        if ($department_id === 1) {
            // للمدير: جميع القطع المباعة من كل الأقسام
            $totalSoldFromSales = SaleItem::sum('quantity');
            $totalSoldFromInvoices = InvoiceItem::sum('quantity');
        } else {
            // للموظف: القطع المباعة من قسمه فقط
            $totalSoldFromSales = SaleItem::whereHas('product', function ($q) use ($department_id) {
                $q->where('department_id', $department_id);
            })->sum('quantity');

            $totalSoldFromInvoices = InvoiceItem::whereHas('productVariant.product', function ($q) use ($department_id) {
                $q->where('department_id', $department_id);
            })->sum('quantity');
        }

        $totalSoldItems = $totalSoldFromSales + $totalSoldFromInvoices;

        // عدد القطع المشتراة (مجموع كميات المشتريات)
        $totalPurchasedItems = $department_id === 1
            ? PurchaseItem::sum('quantity')
            : PurchaseItem::whereHas('product', function ($q) use ($department_id) {
                $q->where('department_id', $department_id);
            })->sum('quantity');

        // عدد القطع المتبقية في المخزن (مجموع الكميات الحالية)
        $totalStockItems = $department_id === 1
            ? Product_variant::sum('quantity')
            : Product_variant::whereHas('product', function ($q) use ($department_id) {
                $q->where('department_id', $department_id);
            })->sum('quantity');

        return view('dashboard.admin', compact(
            'employeesByDepartment',
            'totalEmployees',
            'totalSoldItems',
            'totalPurchasedItems',
            'totalStockItems'
        ));
    }
    public function clothes()
    {
        $user = Auth::guard('employee')->user();
        $department_id = $user->department_id;

        // الموظفين في قسم الملابس فقط
        $totalEmployees = Employee::where('department_id', $department_id)->count();

        // عدد القطع المباعة من قسم الملابس (المبيعات + الفواتير)
        $totalSoldFromSales = SaleItem::whereHas('product', function ($q) use ($department_id) {
            $q->where('department_id', $department_id);
        })->sum('quantity');

        $totalSoldFromInvoices = InvoiceItem::whereHas('productVariant.product', function ($q) use ($department_id) {
            $q->where('department_id', $department_id);
        })->sum('quantity');

        $totalSoldItems = $totalSoldFromSales + $totalSoldFromInvoices;

        // عدد القطع المشتراة لقسم الملابس
        $totalPurchasedItems = PurchaseItem::whereHas('product', function ($q) use ($department_id) {
            $q->where('department_id', $department_id);
        })->sum('quantity');

        // عدد القطع المتبقية في المخزن (مجموع الكميات) من جدول product_variants المرتبطة بمنتجات القسم
        $totalStockItems = Product_variant::whereHas('product', function ($q) use ($department_id) {
            $q->where('department_id', $department_id);
        })->sum('quantity');

        return view('dashboard.clothes', compact(
            'totalEmployees',
            'totalSoldItems',
            'totalPurchasedItems',
            'totalStockItems'
        ));
    }


    public function shoes()
    {
        $user = Auth::guard('employee')->user();
        $user_type = $user->user_type ?? 'employee';
        $department_id = $user->department_id;

        // عدد الموظفين في قسم الأحذية فقط
        $totalEmployees = Employee::where('department_id', $department_id)->count();

        // عدد القطع المباعة من قسم الأحذية (المبيعات + الفواتير)
        $totalSoldFromSales = SaleItem::whereHas('product', function ($q) use ($department_id) {
            $q->where('department_id', $department_id);
        })->sum('quantity');

        $totalSoldFromInvoices = InvoiceItem::whereHas('productVariant.product', function ($q) use ($department_id) {
            $q->where('department_id', $department_id);
        })->sum('quantity');

        $totalSoldItems = $totalSoldFromSales + $totalSoldFromInvoices;

        // عدد القطع المشتراة لقسم الأحذية
        $totalPurchasedItems = PurchaseItem::whereHas('product', function ($q) use ($department_id) {
            $q->where('department_id', $department_id);
        })->sum('quantity');

        // عدد القطع المتبقية في المخزن من المنتجات التابعة لقسم الأحذية
        $totalStockItems = Product_variant::whereHas('product', function ($q) use ($department_id) {
            $q->where('department_id', $department_id);
        })->sum('quantity');

        return view('dashboard.shoes', compact(
            'totalEmployees',
            'totalSoldItems',
            'totalPurchasedItems',
            'totalStockItems'
        ));
    }

}
