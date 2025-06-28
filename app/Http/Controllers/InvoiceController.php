<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::all();
        $invoices = Invoice::with(['department', 'employee'])->orderBy('invoice_date', 'desc')->get();
        return view('invoices.index', compact('invoices','payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

            $departments = Department::all();
            $products = Product::all();
            $employees = Employee::all();
            $invoices = Invoice::all();
            return view('invoices.create', compact('departments', 'products', 'employees','invoices'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'invoice_num' => 'required|integer|unique:invoices,invoice_num',
            'employee_id' => 'required|exists:employees,id',
            'invoice_date' => 'required|date',
            'payment_type' => 'required|string',
            'discount_amount' => 'nullable|numeric|min:0',
            'paid_amount' => 'nullable|numeric|min:0',

            'product_id.*' => 'required|exists:products,id',
            'quantity.*' => 'required|integer|min:1',
            'unit_price.*' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $total = 0;

            foreach ($request->quantity as $index => $qty) {
                $total += $qty * $request->unit_price[$index];
            }

            $discount = $request->discount_amount ?? 0;
            $paid = $request->paid_amount ?? 0;
            $rest = ($total - $discount) - $paid;

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

            foreach ($request->product_id as $index => $product_id) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'product_id' => $product_id,
                    'quantity' => $request->quantity[$index],
                    'unit_price' => $request->unit_price[$index],
                    'total_price' => $request->quantity[$index] * $request->unit_price[$index],
                ]);
            }

            DB::commit();

            return redirect()->route('invoices.index')->with('success', 'تم إنشاء الفاتورة بنجاح');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'حدث خطأ أثناء إنشاء الفاتورة: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
