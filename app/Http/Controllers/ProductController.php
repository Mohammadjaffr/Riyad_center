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
<<<<<<< Updated upstream
        $departments = \App\Models\Department::all();
        return view('pages.add_product', compact('departments'));
=======
        $departments = Department::all();
        return view('products.create', compact('departments'));
>>>>>>> Stashed changes
    }

    public function store(Request $request)
    {
<<<<<<< Updated upstream
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'model_num' => 'required|string|max:255',
=======
        $data = $request->validate([
            'name' => 'required',
            'model_num' => 'required',
            'product_image' => 'nullable|image',
            'description' => 'nullable',
>>>>>>> Stashed changes
            'quantity' => 'required|integer|min:0',
            'cost_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'department_id' => 'required|exists:departments,id',
<<<<<<< Updated upstream
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('product_image')) {
            $imageName = time() . '.' . $request->product_image->extension();
            $request->product_image->move(public_path('uploads/products'), $imageName);
            $validated['product_image'] = 'uploads/products/' . $imageName;
        } else {
            $validated['product_image'] = null; // أو ضع صورة افتراضية إذا أردت
        }
    
        Product::create($validated);
        return redirect()->back()->with('success', 'تمت إضافة المنتج بنجاح');
=======
        ]);

        // رفع الصورة إن وجدت
        if ($request->hasFile('product_image')) {
            $data['product_image'] = $request->file('product_image')->store('products', 'public');
        }

        Product::create($data);
        return redirect()->route('products.index')->with('success', 'تمت إضافة المنتج بنجاح');
>>>>>>> Stashed changes
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
