<?php

namespace App\Http\Controllers;

use App\Models\InventoryLog;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::with('supplier')->latest()->get();
        return view('purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('purchases.create', compact('suppliers', 'products'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_date' => 'required|date',
            'product_id.*' => 'required|exists:products,id',
            'quantity.*' => 'required|integer|min:1',
            'unit_price.*' => 'required|numeric|min:0',
        ], [
            'supplier_id.required' => 'حقل المورد مطلوب.',
            'supplier_id.exists' => 'المورد المختار غير موجود.',
            'purchase_date.required' => 'حقل تاريخ الشراء مطلوب.',
            'purchase_date.date' => 'يجب أن يكون تاريخ الشراء تاريخًا صالحًا.',
            'product_id.*.required' => 'حقل المنتج مطلوب لكل عنصر.',
            'product_id.*.exists' => 'المنتج المختار غير موجود.',
            'quantity.*.required' => 'حقل الكمية مطلوب لكل عنصر.',
            'quantity.*.integer' => 'يجب أن تكون الكمية رقمًا صحيحًا.',
            'quantity.*.min' => 'يجب أن تكون الكمية على الأقل 1.',
            'unit_price.*.required' => 'حقل سعر الوحدة مطلوب لكل عنصر.',
            'unit_price.*.numeric' => 'يجب أن يكون سعر الوحدة رقمًا.',
            'unit_price.*.min' => 'يجب أن يكون سعر الوحدة 0 أو أكثر.',
        ]);


        try {
            $total_amount = 0;

            foreach ($request->quantity as $index => $qty) {
                $total_amount += $qty * $request->unit_price[$index];
            }

            $purchase = Purchase::create([
                'supplier_id' => $request->supplier_id,
                'created_by' => auth()->id(),
                'total_amount' => $total_amount,
                'purchase_date' => $request->purchase_date,
                'notes' => $request->notes,
            ]);

            foreach ($request->product_id as $index => $product_id) {
                $qty = $request->quantity[$index];
                $price = $request->unit_price[$index];

                PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $product_id,
                    'quantity' => $qty,
                    'unit_price' => $price,
                    'total_price' => $qty * $price,
                ]);

                $product = Product::findOrFail($product_id);
                $product->increment('quantity', $qty);

                InventoryLog::create([
                    'product_id' => $product_id,
                    'change_type' => 'شراء',
                    'quantity' => $qty,
                    'description' => 'إضافة مخزون من عملية شراء #' . $purchase->id,
                    'created_by' => auth()->id(),
                    'created_at' => now(),
                ]);
            }


            return redirect()->route('purchases.index')->with('success', 'تمت إضافة عملية الشراء وتحديث المخزون');
        } catch (\Exception $e) {

            return back()->with('error', 'حدث خطأ أثناء الشراء: ' . $e->getMessage());
        }
    }

    public function show(Purchase $purchase)
    {
        return view('purchases.show', compact('purchase'));
    }



}
