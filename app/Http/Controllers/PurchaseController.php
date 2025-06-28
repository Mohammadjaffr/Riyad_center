<?php

namespace App\Http\Controllers;

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
        ]);

        $total_amount = 0;

        foreach ($request->quantity as $index => $qty) {
            $total_amount += $qty * $request->unit_price[$index];
        }

        $purchase = Purchase::create([
            'supplier_id' => $request->supplier_id,
            'created_by' => auth()->user()->id,
            'total_amount' => $total_amount,
            'purchase_date' => $request->purchase_date,
            'notes' => $request->notes,
        ]);

        foreach ($request->product_id as $index => $product_id) {
            PurchaseItem::create([
                'purchase_id' => $purchase->id,
                'product_id' => $product_id,
                'quantity' => $request->quantity[$index],
                'unit_price' => $request->unit_price[$index],
                'total_price' => $request->quantity[$index] * $request->unit_price[$index],
            ]);
        }

        return redirect()->route('purchases.index')->with('success', 'تمت إضافة عملية الشراء');
    }



}
