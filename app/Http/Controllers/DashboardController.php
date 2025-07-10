<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Product_variant;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Department;
use App\Models\SaleItem;
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

        if ($user_type === 'admin') {
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

        $totalSales = $user_type === 'admin'
            ? Sale::count()
            : Sale::where('department_id', $department_id)->count();

        $totalStock = $user_type === 'admin'
            ? Product_variant::sum('quantity')
            : Product_variant::where('product_id', $department_id)->sum('quantity');

        $totalProfit = $user_type === 'admin'
            ? SaleItem::sum(DB::raw('(total_price - unit_price) * quantity'))
            : SaleItem::where('product_id', $department_id)->sum(DB::raw('(total_price - unit_price) * quantity'));

        return view('dashboard.admin', compact(
            'employeesByDepartment',
            'totalEmployees',
            'totalSales',
            'totalStock',
            'totalProfit'
        ));
    }
    public function clothes()
    {
        $user = Auth::guard('employee')->user();
        $department_id = $user->department_id;

        // الموظفين في قسم الملابس فقط
        $totalEmployees = Employee::where('department_id', $department_id)->count();

        // المبيعات الخاصة بقسم الملابس
        $totalSales = Sale::where('department_id', $department_id)->count();

        // المخزون (مجموع الكميات) من جدول product_variants المرتبطة بمنتجات القسم
        $totalStock = Product_variant::whereHas('product', function ($q) use ($department_id) {
            $q->where('department_id', $department_id);
        })->sum('quantity');

        // الربح: مجموع (سعر البيع - سعر الشراء) * الكمية
        $totalProfit = SaleItem::whereHas('product', function ($q) use ($department_id) {
            $q->where('department_id', $department_id);
        })->select(DB::raw('SUM((total_price - unit_price) * quantity) as profit'))->value('profit') ?? 0;

        return view('dashboard.clothes', compact(
            'totalEmployees',
            'totalSales',
            'totalStock',
            'totalProfit'
        ));
    }

    public function shoes()
    {
        $user = Auth::guard('employee')->user();
        $user_type = $user->user_type ?? 'employee';
        $department_id = $user->department_id;

        // عدد الموظفين في قسم الأحذية فقط
        $totalEmployees = Employee::where('department_id', $department_id)->count();

        // عدد المبيعات الخاصة بالقسم
        $totalSales = Sale::where('department_id', $department_id)->count();

        // مجموع الكمية المتوفرة في المخزون من المنتجات التابعة لقسم الأحذية
            $totalStock = Product_variant::whereHas('product', function ($q) use ($department_id) {
            $q->where('department_id', $department_id);
        })->sum('quantity');

        // الربح = (سعر البيع - سعر الشراء) * الكمية
        $totalProfit = SaleItem::whereHas('product', function ($q) use ($department_id) {
            $q->where('department_id', $department_id);
        })->select(DB::raw('SUM((total_price - unit_price) * quantity) as profit'))->value('profit') ?? 0;

        return view('dashboard.shoes', compact(
            'totalEmployees',
            'totalSales',
            'totalStock',
            'totalProfit'
        ));
    }

}
