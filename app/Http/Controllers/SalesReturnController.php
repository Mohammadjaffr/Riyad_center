<?php
namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\InventoryLog;
use App\Models\Product_variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesReturnController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort');
        $employee = Auth::guard('employee')->user();
        $user_type = $employee->user_type ?? 'employee';
        $departmentId = auth()->user()->department_id; // قسم المستخدم الحالي

        $department_id = session('department_id');
        $employees = Employee::where('department_id', $department_id)->get();
        if ($department_id ==1) {
            $logs = InventoryLog::where('change_type', 'مرتجع بيع')
                ->when($search, function ($query, $search) {
                    $query->whereHas('productVariant.product', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
                })
                ->when($sort, function ($query, $sort) {
                    $query->orderBy('created_at', $sort);
                }, function ($query) {
                    $query->latest();
                })
                ->with('productVariant.product')
                ->paginate(10);
        }else{
            $logs = InventoryLog::where('change_type', 'مرتجع بيع')
            ->when($search, function ($query, $search) {
                $query->whereHas('productVariant.product', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            // هنا نضيف شرط القسم
            ->whereHas('productVariant.product', function ($q) use ($departmentId) {
                $q->where('department_id', $departmentId);
            })
            ->when($sort, function ($query, $sort) {
                $query->orderBy('created_at', $sort);
            }, function ($query) {
                $query->latest();
            })
            ->with('productVariant.product')
            ->paginate(10);

        }
//        $logs = InventoryLog::where('change_type', 'مرتجع بيع')->latest()->with('productVariant.product')->paginate(20);
        return view('sales_returns.index', compact('logs'));
    }

    public function create()
    {
        $employee = Auth::guard('employee')->user();
        $user_type = $employee->user_type ?? 'employee';

        $department_id = session('department_id');
        $employees = Employee::where('department_id', $department_id)->get();
        if ($department_id ==1){
            $invoices = Invoice::with('items.productVariant.product')->get();

        }else{
            $invoices = Invoice::with('items.productVariant.product')->where( 'department_id',$department_id)->get();
        }

//        $invoices = Invoice::with('items.productVariant.product')->get();
        return view('sales_returns.create', compact('invoices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice_item_id' => 'required|exists:invoice_items,id',
            'return_quantity' => 'required|integer|min:1',
            'reason' => 'nullable|string|max:255',
        ]);

        $item = InvoiceItem::with('productVariant')->findOrFail($request->invoice_item_id);
        $product = $item->productVariant;

        // حساب كمية المرتجعات السابقة لنفس عنصر الفاتورة
        $returnedQuantity = InventoryLog::where('change_type', 'مرتجع بيع')
            ->where('invoice_item_id', $item->id)
            ->sum('quantity');

        $availableForReturn = $item->quantity - $returnedQuantity;

        if ($request->return_quantity > $availableForReturn || $availableForReturn <= 0) {
            return back()->withErrors(['return_quantity' => 'لا يمكن إرجاع كمية أكبر من الكمية المتاحة أو لا توجد كمية متاحة للإرجاع.']);
        }

        // زيادة الكمية في المخزون
        $product->increment('quantity', $request->return_quantity);

        // تسجيل المرتجع في سجل المخزون
        InventoryLog::create([
            'invoice_item_id' => $item->id,
            'product_variant_id' => $product->id,
            'change_type' => 'مرتجع بيع',
            'quantity' => $request->return_quantity,
            'description' => $request->reason ?? 'إرجاع منتج من الفاتورة #' . $item->invoice_id,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('sales-returns.index')->with('success', 'تم تسجيل المرتجع بنجاح.');
    }
}
