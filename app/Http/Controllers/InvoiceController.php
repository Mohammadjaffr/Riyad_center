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
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Invoice::with(['department', 'employee']);

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


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        $products = Product::all();
        $employees = Employee::all();

        $lastInvoice = Invoice::orderBy('id', 'desc')->first();

        $nextNumber = $lastInvoice ? intval($lastInvoice->invoice_num) + 1 : 1;

        $invoice_num = str_pad($nextNumber, 7, '0', STR_PAD_LEFT);

        return view('invoices.create', compact('departments', 'products', 'employees', 'invoice_num'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'invoice_num' => 'required|string|unique:invoices,invoice_num',
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
            // التحقق من الكميات المتوفرة لكل متغير
            foreach ($request->variant_id as $index => $variant_id) {
                $variant = Product_variant::findOrFail($variant_id);
                $qty = $request->quantity[$index];

                if ($variant->quantity < $qty) {
                    return back()->withErrors([
                        "variant_id.{$index}" => "الكمية غير كافية للمنتج: {$variant->name}"
                    ])->withInput();
                }
            }

            // حساب المجموع الكلي
            $total = 0;
            foreach ($request->quantity as $index => $qty) {
                $total += $qty * $request->unit_price[$index];
            }

            $discount = $request->discount_amount ?? 0;
            $paid = $request->paid_amount ?? 0;
            $rest = ($total - $discount) - $paid;

            // إنشاء الفاتورة
            $invoice = Invoice::create([
                'customer_name' => $request->customer_name,
                'department_id' => $request->department_id,
                'invoice_num' => $request->invoice_num,
                'discount_amount' => $discount,
                'employee_id' => $request->employee_id,
                'total_amount' => $total - $discount,
                'paid_amount' => $paid,
                'rest_amount' => $rest,
                'payment_type' => $request->payment_type,
                'notes' => $request->notes,
                'invoice_date' => $request->invoice_date,
            ]);

            // حفظ العناصر مع تحديث الكميات وتسجيل حركة المخزون
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

                // خصم الكمية من المتغير
                $variant->decrement('quantity', $qty);

                // تسجيل حركة المخزون
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
        $invoice->load(['department', 'employee', 'items.product']);
        return view('invoices.show', compact('invoice'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $departments = Department::all();
        $products = Product::all();
        $employees = Employee::all();
        $invoice->load('items');

        return view('invoices.edit', compact('invoice', 'departments', 'products', 'employees'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
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
            $total = 0;
            foreach ($request->quantity as $index => $qty) {
                $total += $qty * $request->unit_price[$index];
            }

            $discount = $request->discount_amount ?? 0;
            $paid = $request->paid_amount ?? 0;
            $rest = ($total - $discount) - $paid;

            $invoice->update([
                'customer_name' => $request->customer_name,
                'department_id' => $request->department_id,
                'discount_amount' => $discount,
                'employee_id' => $request->employee_id,
                'total_amount' => $total - $discount,
                'paid_amount' => $paid,
                'rest_amount' => $rest,
                'payment_type' => $request->payment_type,
                'notes' => $request->notes,
                'invoice_date' => $request->invoice_date,
            ]);


            $invoice->items()->delete();

            foreach ($request->variant_id as $index => $variant_id) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'product_variant_id' => $variant_id,
                    'quantity' => $request->quantity[$index],
                    'unit_price' => $request->unit_price[$index],
                    'total_price' => $request->quantity[$index] * $request->unit_price[$index],
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
        $pdf = PDf::loadView('invoices.pdf', compact('invoice'))->setPaper('A4', 'portrait');

        return $pdf->stream('invoice-' . $invoice->invoice_num . '.pdf');
    }

}
