<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with('employee', 'department')->latest()->get();
        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $departments = Department::all();
        return view('sales.create', compact('products', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'nullable|string',
            'department_id' => 'required|exists:departments,id',
            'sale_date' => 'required|date',
            'product_id.*' => 'required|exists:products,id',
            'quantity.*' => 'required|integer|min:1',
            'unit_price.*' => 'required|numeric|min:0',
        ], [
            'customer_name.string' => 'اسم العميل يجب أن يكون نصاً.',

            'department_id.required' => 'حقل القسم مطلوب.',
            'department_id.exists' => 'القسم المختار غير موجود.',

            'sale_date.required' => 'حقل تاريخ البيع مطلوب.',
            'sale_date.date' => 'يجب أن يكون تاريخ البيع تاريخاً صحيحاً.',

            'product_id.*.required' => 'حقل المنتج مطلوب لكل عنصر.',
            'product_id.*.exists' => 'أحد المنتجات المختارة غير موجود.',

            'quantity.*.required' => 'حقل الكمية مطلوب لكل عنصر.',
            'quantity.*.integer' => 'يجب أن تكون الكمية رقماً صحيحاً.',
            'quantity.*.min' => 'الحد الأدنى للكمية هو 1.',

            'unit_price.*.required' => 'حقل سعر الوحدة مطلوب لكل عنصر.',
            'unit_price.*.numeric' => 'يجب أن يكون سعر الوحدة رقماً.',
            'unit_price.*.min' => 'الحد الأدنى لسعر الوحدة هو 0.',
        ]);


        $total_amount = 0;

        foreach ($request->quantity as $index => $qty) {
            $total_amount += $qty * $request->unit_price[$index];
        }

        $sale = Sale::create([
            'customer_name' => $request->customer_name,
            'created_by' => auth()->user()->id,
            'total_amount' => $total_amount,
            'notes' => $request->notes,
            'department_id' => $request->department_id,
        ]);

        foreach ($request->product_id as $index => $product_id) {
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $product_id,
                'quantity' => $request->quantity[$index],
                'unit_price' => $request->unit_price[$index],
                'total_price' => $request->quantity[$index] * $request->unit_price[$index],
            ]);
        }

        return redirect()->route('sales.index')->with('success', 'تمت عملية البيع بنجاح');
    }


    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
