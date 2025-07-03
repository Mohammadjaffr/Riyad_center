<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort');

        $payments = Payment::with(['invoice', 'creator'])
            ->when($search, function ($query, $search) {
                $query->where('payment_reference', 'like', "%{$search}%")
                    ->orWhereHas('invoice', function ($q) use ($search) {
                        $q->where('invoice_num', 'like', "%{$search}%")
                            ->orWhereHas('employee', function ($q2) use ($search) {
                                $q2->where('name', 'like', "%{$search}%");
                            });
                    });
            })
            ->when($sort, function ($query, $sort) {
                $query->orderBy('amount', $sort);
            }, function ($query) {
                $query->orderByDesc('payment_date');
            })
            ->paginate(10);

        $invoices = Invoice::all();

        return view('payments.index', compact('payments', 'invoices'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $invoices = Invoice::all();
        return view('payments.create', compact('invoices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'amount' => 'required|numeric|min:1',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        Payment::create([
            'invoice_id' => $request->invoice_id,
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'payment_method' => $request->payment_method,
            'notes' => $request->notes,
            'created_by' => auth()->user()->id,
        ]);

        return redirect()->route('payments.index')->with('success', 'تم تسجيل الدفعة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
