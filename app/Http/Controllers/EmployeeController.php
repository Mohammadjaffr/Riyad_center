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
    public function index()
    {
        $employees = Employee::with('department')->get();
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
            'name' => 'required',
            'phone' => 'required|unique:employees',
            'password' => 'required',
            'status' => 'required',
            'role' => 'required',
            'salary' => 'required|numeric',
            'department_id' => 'required|exists:departments,id',
        ]);

        $data['password'] = bcrypt($data['password']);

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
