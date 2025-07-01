<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeSalary;
use Illuminate\Http\Request;

class EmployeeSalaryController extends Controller
{
    public function index()
    {
        $salaries = EmployeeSalary::with('employee')->latest()->get();
        return view('employee_salaries.index', compact('salaries'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('employee_salaries.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'amount' => 'required|numeric|min:0',
            'pay_date' => 'required|date',
            'notes' => 'nullable|string',
        ], [
            'employee_id.required' => 'حقل اسم الموظف مطلوب.',
            'employee_id.exists' => 'الموظف المختار غير موجود.',

            'amount.required' => 'حقل المبلغ مطلوب.',
            'amount.numeric' => 'يجب أن يكون المبلغ رقماً.',
            'amount.min' => 'الحد الأدنى للمبلغ هو 0.',

            'pay_date.required' => 'حقل تاريخ الدفع مطلوب.',
            'pay_date.date' => 'يجب أن يكون تاريخ الدفع تاريخاً صحيحاً.',

            'notes.string' => 'الملاحظات يجب أن تكون نصاً.',
        ]);


        EmployeeSalary::create([
            'employee_id' => $request->employee_id,
            'amount' => $request->amount,
            'pay_date' => $request->pay_date,
            'notes' => $request->notes,
            'created_at' => now(),
        ]);

        return redirect()->route('employee-salaries.index')->with('success', 'تم تسجيل الراتب بنجاح');
    }
}
