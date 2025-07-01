<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\InventoryLog;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InventoryLogController extends Controller
{
    public function index()
    {
        $logs = InventoryLog::with('product', 'employee')->latest()->get();
        return view('inventory_logs.index', compact('logs'));
    }

    public function create()
    {
        $products = Product::all();
        return view('inventory_logs.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_variant_id' => 'required|exists:product_variants,id',
            'change_type' => 'required|in:شراء,بيع,تعديل يدوي',
            'quantity' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        InventoryLog::create([
            'product_variant_id' => $request->product_variant_id,
            'change_type' => $request->change_type,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'created_by' => auth()->user()->id ?? 1,
            'created_at' => now(),
        ]);

        return redirect()->route('inventory-logs.index')->with('success', 'تم تسجيل التعديل على المخزون.');
    }


    public function report(Request $request, $type)
    {
        $product_variant_id = $request->input('product_variant_id');
        $employee_id = $request->input('employee_id');
        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        $products = Product::all();
        $employees = Employee::all();

        if ($type == 'current') {
            $query = InventoryLog::selectRaw('product_variant_id,
            SUM(CASE WHEN change_type = "شراء" THEN quantity ELSE 0 END) -
            SUM(CASE WHEN change_type = "بيع" THEN quantity ELSE 0 END) +
            SUM(CASE WHEN change_type = "تعديل يدوي" THEN quantity ELSE 0 END) as current_stock')
                ->groupBy('product_variant_id')
                ->with('productVariant.product'); // مهم هنا

            if ($product_variant_id) {
                $query->having('product_variant_id', '=', $product_variant_id);
            }

            $stock = $query->get();

            return view('inventory_logs.reports.current', compact('stock', 'products', 'employees', 'type'));
        }

        $query = InventoryLog::with('product', 'employee');

        if ($product_variant_id) {
            $query->where('product_variant_id', $product_variant_id);
        }

        if ($employee_id) {
            $query->where('created_by', $employee_id);
        }

        if ($date_from) {
            $query->whereDate('created_at', '>=', $date_from);
        }

        if ($date_to) {
            $query->whereDate('created_at', '<=', $date_to);
        }

        if ($type == 'monthly') {
            $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
        }

        if ($type == 'yearly') {
            $query->whereYear('created_at', now()->year);
        }
        if ($type == 'daily') {
            $query->whereDay('created_at', now()->day);
        }

        $logs = $query->latest()->get();

        return view("inventory_logs.reports.$type", compact('logs', 'products', 'employees', 'type'));
    }

    public function exportPdf(Request $request, $type)
    {
        $data = $this->getFilteredLogs($request, $type);

        $pdf = PDF::loadView("inventory_logs.reports.pdf.$type", $data);
        return $pdf->download("تقرير-الجرد-{$type}.pdf");
    }
    public function getFilteredLogs($request, $type)
    {
        $query = InventoryLog::with('productVariant.product', 'employee');

        if ($request->filled('product_variant_id')) {
            $query->where('product_variant_id', $request->product_variant_id);
        }

        if ($request->filled('employee_id')) {
            $query->where('created_by', $request->employee_id);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($type == 'monthly') {
            $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
        }

        if ($type == 'yearly') {
            $query->whereYear('created_at', now()->year);
        }

        return ['logs' => $query->get(), 'products' => Product::all(), 'employees' => Employee::all()];
    }

}
