<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Department;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('department')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {

        $departments = Department::all();
        return view('products.create', compact('departments'));

    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'model_num' => 'required',
            'product_image' => 'nullable|image',
            'description' => 'nullable',
            'quantity' => 'required|integer|min:0',
            'cost_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'department_id' => 'required|exists:departments,id',
        ]);


        // رفع الصورة إن وجدت
        if ($request->hasFile('product_image')) {
            $data['product_image'] = $request->file('product_image')->store('products', 'public');
        }

        Product::create($data);
        return redirect()->route('products.index')->with('success', 'تمت إضافة المنتج بنجاح');

    }

    public function edit(Product $product)
    {
        $departments = Department::all();
        return view('products.edit', compact('product', 'departments'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required',
            'model_num' => 'required',
            'product_image' => 'nullable|image',
            'description' => 'nullable',
            'quantity' => 'required|integer|min:0',
            'cost_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'department_id' => 'required|exists:departments,id',
        ]);

        if ($request->hasFile('product_image')) {
            $data['product_image'] = $request->file('product_image')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->route('products.index')->with('success', 'تم تعديل المنتج');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'تم حذف المنتج');
    }
}
