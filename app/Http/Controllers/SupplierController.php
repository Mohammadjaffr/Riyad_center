<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::with('department')->get();
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('suppliers.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'nullable',
            'address' => 'nullable',
            'department_id' => 'required|exists:departments,id',
        ]);

        Supplier::create($data);
        return redirect()->route('suppliers.index')->with('success', 'تمت إضافة المورد');
    }

    public function edit(Supplier $supplier)
    {
        $departments = Department::all();
//        $supplier = Supplier::all();
        return view('suppliers.edit', compact('supplier', 'departments'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'nullable',
            'address' => 'nullable',
            'department_id' => 'required|exists:departments,id',
        ]);

        $supplier->update($data);
        return redirect()->route('suppliers.index')->with('success', 'تم تحديث المورد');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'تم حذف المورد');
    }
}
