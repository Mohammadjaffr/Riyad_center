<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\InventoryLog;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Product_variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;


class InvoiceController extends Controller
{
//    function __construct()
//    {
////        $this->middleware('permission:عرض المنتجات',['only'=>['index']]);
//    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Invoice::with(['department', 'employee']);

        $user = Auth::guard('employee')->user();
        $user_type = $user->user_type ?? 'employee';
        $department_id = $user->department_id;

        if ($user_type !== 'admin' && $department_id !== null) {
            $query->where('department_id', $department_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('invoice_num', 'like', "%{$search}%")
                    ->orWhereHas('employee', function ($empQuery) use ($search) {
                        $empQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('sort') && in_array($request->sort, ['asc', 'desc'])) {
            $query->orderBy('invoice_date', $request->sort);
        } else {
            $query->latest('invoice_date');
        }

        $invoices = $query->paginate(10);
        $payments = Payment::all();

        return view('invoices.index', compact('invoices', 'payments'));
    }

    public function create()
    {
        $employee = Auth::guard('employee')->user();
        $user_type = $employee->user_type ?? 'employee';

        $department_id = session('department_id');


        $employees = Employee::where('department_id', $department_id)->get();
        if ($department_id ==1){
            $products = Product::with('variants')->get();
            $departments = Department::where('id', null ?? 'admin')->get();

        }else{
            $products = Product::with('variants')
                ->where('department_id', $department_id)
                ->get();
            $departments = Department::where('id', $department_id)->get();
        }


        $lastInvoice = Invoice::where('department_id', $department_id)
            ->orderBy('invoice_num', 'desc')
            ->first();

        $nextNumber = $lastInvoice ? intval($lastInvoice->invoice_num) + 1 : 1;
        $invoice_num = str_pad($nextNumber, 7, '0', STR_PAD_LEFT);

        return view('invoices.create', compact('departments', 'employees', 'products', 'invoice_num'));
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::guard('employee')->user();
        $user_type = $user->user_type ?? 'employee';

        // تحديد القسم المستخدم
        $departmentToUse = $user_type === 'admin' ? $request->department_id : $user->department_id;

        // جلب بيانات القسم
        $department = Department::find($departmentToUse);

        // تحديد البادئة بناءً على اسم القسم
        $prefix = match (true) {
            str_contains($department->name, 'ملابس') => 'CH', // ملابس = CH
            str_contains($department->name, 'أحذية') => 'SH', // أحذية = SH
            default => 'DEPT',
        };

        // جلب آخر فاتورة لهذا القسم لتحديد الرقم التالي
        $latestInvoice = Invoice::where('department_id', $departmentToUse)->latest('id')->first();
        $nextNumber = $latestInvoice ? $latestInvoice->id + 1 : 1;

        // تنسيق رقم الفاتورة
        $invoiceNum = $prefix . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // التحقق من البيانات
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'invoice_date' => 'required|date',
            'payment_type' => 'required|string',
            'discount_amount' => 'nullable|numeric|min:0',
            'paid_amount' => 'nullable|numeric|min:0',
            'variant_id.*' => 'required|exists:product_variants,id',
            'quantity.*' => 'required|integer|min:1',
            'unit_price.*' => 'required|numeric|min:0',
        ]);

        try {
            // التأكد من توفر الكمية
            foreach ($request->variant_id as $index => $variant_id) {
                $variant = Product_variant::findOrFail($variant_id);
                $qty = $request->quantity[$index];
                if ($variant->quantity < $qty) {
                    return back()->withErrors([
                        "variant_id.{$index}" => "الكمية غير كافية للمنتج: {$variant->name}"
                    ])->withInput();
                }
            }

            // حساب الإجمالي والخصم والباقي
            $total = collect($request->quantity)->zip($request->unit_price)->sum(function ($pair) {
                return $pair[0] * $pair[1];
            });

            $discount = $request->discount_amount ?? 0;
            $paid = $request->paid_amount ?? 0;
            $rest = ($total - $discount) - $paid;

            // إنشاء الفاتورة
            $invoice = Invoice::create([
                'customer_name' => $request->customer_name,
                'department_id' => $departmentToUse,
                'invoice_num' => $invoiceNum,
                'discount_amount' => $discount,
                'employee_id' => $request->employee_id,
                'total_amount' => $total - $discount,
                'paid_amount' => $paid,
                'rest_amount' => $rest,
                'payment_type' => $request->payment_type,
                'notes' => $request->notes,
                'invoice_date' => $request->invoice_date,
            ]);

            // إنشاء العناصر وتحديث الكمية
            foreach ($request->variant_id as $index => $variant_id) {
                $qty = $request->quantity[$index];
                $unit_price = $request->unit_price[$index];
                $variant = Product_variant::findOrFail($variant_id);

                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'product_variant_id' => $variant_id,
                    'quantity' => $qty,
                    'unit_price' => $unit_price,
                    'total_price' => $qty * $unit_price,
                ]);

                // خصم الكمية من المخزون
                $variant->decrement('quantity', $qty);

                // تسجيل حركة الجرد
                InventoryLog::create([
                    'product_variant_id' => $variant_id,
                    'change_type' => 'بيع',
                    'quantity' => -$qty,
                    'description' => 'بيع عبر فاتورة #' . $invoice->invoice_num,
                    'created_by' => auth()->id(),
                    'created_at' => now(),
                ]);
            }

            return redirect()->route('invoices.index')->with('success', 'تم إنشاء الفاتورة بنجاح');
        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء إنشاء الفاتورة: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $user = Auth::guard('employee')->user();

        $user_type = $user->user_type ?? 'employee';

        if ($user_type !== 'admin' && $invoice->department_id !== $user->department_id) {
            abort(403, 'ليس لديك صلاحية مشاهدة هذه الفاتورة');
        }

        $invoice->load(['department', 'employee', 'items.productVariant.product']);

        return view('invoices.show', compact('invoice'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $user = Auth::guard('employee')->user();
        $user_type = $user->user_type ?? 'employee';
        $employee = Auth::guard('employee')->user();

        $department_id = session('department_id');

        if ($department_id == 1) {
            $departments = Department::all();
            $products = Product::with('variants')->get();
            $employees = Employee::all();
        } else {
            $department_id = $user->department_id;

            $departments = Department::where('id', $department_id)->get();
            $products = Product::with('variants')->where('department_id', $department_id)->get();
            $employees = Employee::where('department_id', $department_id)->get();
        }

        $invoice->load('items');

        return view('invoices.edit', compact('invoice', 'departments', 'products', 'employees'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $user = Auth::guard('employee')->user();
        $user_type = $user->user_type ?? 'employee';

        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'invoice_date' => 'required|date',
            'payment_type' => 'required|string',
            'discount_amount' => 'nullable|numeric|min:0',
            'paid_amount' => 'nullable|numeric|min:0',
            'variant_id.*' => 'required|exists:product_variants,id',
            'quantity.*' => 'required|integer|min:1',
            'unit_price.*' => 'required|numeric|min:0',
        ]);

        if ($user_type == 'admin') {
            $departmentToUse = $request->department_id;
        } else {
            $departmentToUse = $user->department_id;
        }

        try {
            // استرجاع العناصر القديمة لزيادة المخزون
            foreach ($invoice->items as $oldItem) {
                $variant = Product_variant::find($oldItem->product_variant_id);
                if ($variant) {
                    $variant->increment('quantity', $oldItem->quantity);

                    // حذف سجل الحركة القديم إذا أردت، أو إضافة حركة إرجاع
                    InventoryLog::create([
                        'product_variant_id' => $variant->id,
                        'change_type' => 'إرجاع تعديل فاتورة',
                        'quantity' => $oldItem->quantity,
                        'description' => 'إرجاع كمية عند تعديل فاتورة #' . $invoice->invoice_num,
                        'created_by' => auth()->id(),
                        'created_at' => now(),
                    ]);
                }
            }

            // حذف العناصر القديمة
            $invoice->items()->delete();

            // حساب المجموع الجديد
            $total = 0;
            foreach ($request->quantity as $index => $qty) {
                $total += $qty * $request->unit_price[$index];
            }

            $discount = $request->discount_amount ?? 0;
            $paid = $request->paid_amount ?? 0;
            $rest = ($total - $discount) - $paid;

            // تحديث بيانات الفاتورة
            $invoice->update([
                'customer_name' => $request->customer_name,
                'department_id' => $departmentToUse,
                'discount_amount' => $discount,
                'employee_id' => $request->employee_id,
                'total_amount' => $total - $discount,
                'paid_amount' => $paid,
                'rest_amount' => $rest,
                'payment_type' => $request->payment_type,
                'notes' => $request->notes,
                'invoice_date' => $request->invoice_date,
            ]);

            // إنشاء العناصر الجديدة وتقليل الكمية من المخزون
            foreach ($request->variant_id as $index => $variant_id) {
                $qty = $request->quantity[$index];
                $unit_price = $request->unit_price[$index];
                $variant = Product_variant::findOrFail($variant_id);

                // تحقق من توفر الكمية المطلوبة
                if ($variant->quantity < $qty) {
                    return back()->withErrors([
                        "variant_id.{$index}" => "الكمية غير كافية للمنتج: {$variant->name}"
                    ])->withInput();
                }

                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'product_variant_id' => $variant_id,
                    'quantity' => $qty,
                    'unit_price' => $unit_price,
                    'total_price' => $qty * $unit_price,
                ]);

                $variant->decrement('quantity', $qty);

                InventoryLog::create([
                    'product_variant_id' => $variant_id,
                    'change_type' => 'بيع تعديل فاتورة',
                    'quantity' => -$qty,
                    'description' => 'بيع عبر تعديل فاتورة #' . $invoice->invoice_num,
                    'created_by' => auth()->id(),
                    'created_at' => now(),
                ]);
            }

            return redirect()->route('invoices.index')->with('success', 'تم تحديث الفاتورة بنجاح');
        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء التحديث: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        try {
            foreach ($invoice->items as $item) {
                $variant = Product_variant::find($item->product_variant_id);
                if ($variant) {

                    $variant->increment('quantity', $item->quantity);

                    InventoryLog::create([
                        'product_variant_id' => $variant->id,
                        'change_type' => 'إرجاع حذف فاتورة',
                        'quantity' => $item->quantity,
                        'description' => 'إرجاع كمية عند حذف فاتورة #' . $invoice->invoice_num,
                        'created_by' => auth()->id(),
                        'created_at' => now(),
                    ]);
                }
            }
            $invoice->items()->delete();
            $invoice->delete();

            return redirect()->route('invoices.index')->with('success', 'تم حذف الفاتورة بنجاح');
        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء الحذف: ' . $e->getMessage());
        }
    }

    public function print(Invoice $invoice)
    {
        $invoice->load(['department', 'employee', 'items.productVariant.product']);

        $pdf = PDF::loadView('invoices.pdf', compact('invoice'), [], [
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'amiri',
        ]);

        return $pdf->stream('invoice-' . $invoice->invoice_num . '.pdf');
    }

}
