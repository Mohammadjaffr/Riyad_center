<?php

namespace App\Http\Controllers;
use App\Models\Department;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $employees = Employee::with('department')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->get();

        return view('employees.index', compact('employees'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('employees.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|unique:employees,phone',
            'password' => 'required|string|min:6',
            'status' => 'required',
            'role' => 'required|string|max:50',
            'salary' => 'required|numeric|min:0',
            'department_id' => 'required|exists:departments,id',
        ], [
            'name.required' => 'حقل الاسم مطلوب',
            'phone.required' => 'حقل الهاتف مطلوب',
            'phone.unique' => 'رقم الهاتف مستخدم بالفعل',

            'password.required' => 'حقل كلمة المرور مطلوب',
            'password.string' => 'يجب أن تكون كلمة المرور نصًا',
            'password.min' => 'كلمة المرور يجب أن تكون على الأقل 6 حروف',

            'status.required' => 'حقل الحالة مطلوب',
//            'status.in' => 'الحالة المختارة غير صحيحة',

            'role.required' => 'حقل الدور مطلوب',
            'role.string' => 'يجب أن يكون الدور نصًا',
            'role.max' => 'الدور لا يجب أن يتجاوز 50 حرفًا',

            'salary.required' => 'حقل الراتب مطلوب',
            'salary.numeric' => 'يجب أن يكون الراتب رقمًا',
            'salary.min' => 'الراتب لا يمكن أن يكون أقل من صفر',

            'department_id.required' => 'يجب اختيار القسم',
            'department_id.exists' => 'القسم المحدد غير موجود',
        ]);

        $data['password'] = Hash::make($data['password']);

        Employee::create($data);
        return redirect()->route('employees.index')->with('success', 'تمت إضافة الموظف بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $departments = Department::all();
        return view('employees.edit', compact('employee', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:employees,phone,' . $employee->id,
            'status' => 'required',
            'role' => 'required',
            'salary' => 'required|numeric',
            'department_id' => 'required|exists:departments,id',
        ]);

        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }else {
            unset($data['password']);
        }

        $employee->update($data);
        return redirect()->route('employees.index')->with('success', 'تم تعديل الموظف');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'تم حذف الموظف');
    }
}
