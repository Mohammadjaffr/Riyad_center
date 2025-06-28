<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeAdvancePayment;
use Illuminate\Http\Request;

class EmployeeAdvancePaymentController extends Controller
{
    public function index()
    {
        $advances = EmployeeAdvancePayment::with('employee', 'creator')->latest()->get();
        return view('employee_advance_payments.index', compact('advances'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('employee_advance_payments.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'amount' => 'required|numeric|min:0',
            'reason' => 'required|string',
            'payment_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        EmployeeAdvancePayment::create([
            'employee_id' => $request->employee_id,
            'amount' => $request->amount,
            'reason' => $request->reason,
            'payment_date' => $request->payment_date,
            'notes' => $request->notes,
            'created_by' => auth()->user()->id ?? 1,
            'created_at' => now(),
        ]);

        return redirect()->route('employee-advance-payments.index')->with('success', 'تم تسجيل السلفة بنجاح');
    }

}
