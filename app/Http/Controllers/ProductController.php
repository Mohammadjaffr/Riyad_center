<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with(['department', 'variants']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('model_num', 'like', "%{$search}%");
            });
        }

        if ($request->filled('sort')) {
            $query->orderBy('name', $request->sort);
        } else {
            $query->latest();
        }

        $products = $query->paginate(10);

        return view('products.index', compact('products'));
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('products.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'model_num' => 'nullable|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'description' => 'nullable|string',
            'product_image' => 'nullable|image|max:2048',

            'variants' => 'required|array|min:1',
            'variants.*.size' => 'required|string',
            'variants.*.color' => 'required|string',
            'variants.*.quantity' => 'required|integer|min:0',
            'variants.*.sell_price' => 'required|numeric|min:0',
            'variants.*.cost_price' => 'required|numeric|min:0',
        ], [
            'name.required' => 'حقل اسم المنتج مطلوب',
            'name.string' => 'يجب أن يكون اسم المنتج نصًا',
            'name.max' => 'اسم المنتج يجب ألا يتجاوز 255 حرفًا',

            'model_num.string' => 'يجب أن يكون رقم الموديل نصًا',
            'model_num.max' => 'رقم الموديل يجب ألا يتجاوز 255 حرفًا',

            'department_id.required' => 'يجب اختيار القسم',
            'department_id.exists' => 'القسم المحدد غير موجود',

            'description.string' => 'يجب أن يكون الوصف نصًا',

            'product_image.image' => 'يجب أن تكون صورة المنتج ملف صورة',
            'product_image.max' => 'حجم صورة المنتج يجب ألا يتجاوز 2 ميغابايت',

            'variants.required' => 'يجب إدخال متغيرات المنتج',
            'variants.array' => 'المتغيرات يجب أن تكون مصفوفة',
            'variants.min' => 'يجب إدخال متغير واحد على الأقل',

            'variants.*.size.required' => 'حقل المقاس مطلوب لكل متغير',
            'variants.*.size.string' => 'حقل المقاس يجب أن يكون نصًا',

            'variants.*.color.required' => 'حقل اللون مطلوب لكل متغير',
            'variants.*.color.string' => 'حقل اللون يجب أن يكون نصًا',

            'variants.*.quantity.required' => 'حقل الكمية مطلوب لكل متغير',
            'variants.*.quantity.integer' => 'الكمية يجب أن تكون عددًا صحيحًا',
            'variants.*.quantity.min' => 'الكمية لا يمكن أن تكون أقل من 0',

            'variants.*.sell_price.required' => 'حقل سعر البيع مطلوب لكل متغير',
            'variants.*.sell_price.numeric' => 'حقل سعر البيع يجب أن يكون رقمًا',
            'variants.*.sell_price.min' => 'سعر البيع لا يمكن أن يكون أقل من 0',

            'variants.*.cost_price.required' => 'حقل سعر التكلفة مطلوب لكل متغير',
            'variants.*.cost_price.numeric' => 'حقل سعر التكلفة يجب أن يكون رقمًا',
            'variants.*.cost_price.min' => 'سعر التكلفة لا يمكن أن تكون أقل من 0',
        ]);

        // حفظ بيانات المنتج
        $data = $request->only(['name', 'model_num', 'department_id', 'description']);

        if ($request->hasFile('product_image')) {
            $path = $request->file('product_image')->store('products', 'public');
            $data['product_image'] = $path;
        }

        $product = Product::create($data);

        // حفظ المتغيرات المرتبطة بالمنتج
        foreach ($request->variants as $variant) {
            $product->variants()->create([
                'size' => $variant['size'],
                'color' => $variant['color'],
                'quantity' => $variant['quantity'],
                'sell_price' => $variant['sell_price'],
                'cost_price' => $variant['cost_price'],
            ]);
        }

        return redirect()->route('products.index')->with('success', 'تم إنشاء المنتج مع المتغيرات بنجاح.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $departments = Department::all();
        return view('products.edit', compact('product', 'departments'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'model_num' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'cost_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'department_id' => 'required|exists:departments,id',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'حقل اسم المنتج مطلوب',
            'name.string' => 'يجب أن يكون اسم المنتج نصًا',
            'name.max' => 'اسم المنتج يجب ألا يتجاوز 255 حرفًا',

            'description.required' => 'حقل الوصف مطلوب',
            'description.string' => 'يجب أن يكون الوصف نصًا',

            'model_num.required' => 'حقل رقم الموديل مطلوب',
            'model_num.string' => 'يجب أن يكون رقم الموديل نصًا',
            'model_num.max' => 'رقم الموديل يجب ألا يتجاوز 255 حرفًا',

            'quantity.required' => 'حقل كمية المخزون مطلوب',
            'quantity.integer' => 'يجب أن تكون كمية المخزون عددًا صحيحًا',
            'quantity.min' => 'كمية المخزون لا يمكن أن تكون أقل من 0',

            'cost_price.required' => 'حقل سعر التكلفة مطلوب',
            'cost_price.numeric' => 'يجب أن يكون سعر التكلفة رقمًا',
            'cost_price.min' => 'سعر التكلفة لا يمكن أن يكون أقل من 0',

            'sell_price.required' => 'حقل سعر البيع مطلوب',
            'sell_price.numeric' => 'يجب أن يكون سعر البيع رقمًا',
            'sell_price.min' => 'سعر البيع لا يمكن أن يكون أقل من 0',

            'department_id.required' => 'يجب اختيار القسم',
            'department_id.exists' => 'القسم المحدد غير موجود',

            'product_image.image' => 'يجب أن تكون صورة المنتج ملف صورة',
            'product_image.mimes' => 'يجب أن تكون صيغة الصورة jpeg أو png أو jpg أو gif',
            'product_image.max' => 'حجم صورة المنتج يجب ألا يتجاوز 2 ميغابايت',
        ]);

        if ($request->hasFile('product_image')) {
            $imageName = time() . '.' . $request->product_image->extension();
            $request->product_image->move(public_path('uploads/products'), $imageName);
            $validated['product_image'] = 'uploads/products/' . $imageName;
        }

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'تم تحديث المنتج بنجاح');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'تم حذف المنتج بنجاح.');
    }
}
