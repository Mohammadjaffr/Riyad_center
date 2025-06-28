<?php

namespace App\Http\Controllers;

use App\Models\InventoryLog;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryLogController extends Controller
{
    public function index()
    {
        $logs = InventoryLog::with('product', 'employee')->latest()->get();
        return view('inventory_logs.index', compact('logs'));
    }

    public function create()
    {
        $products = Product::all();
        return view('inventory_logs.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'change_type' => 'required|in:شراء,بيع,تعديل يدوي',
            'quantity' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        InventoryLog::create([
            'product_id' => $request->product_id,
            'change_type' => $request->change_type,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'created_by' => auth()->user()->id ?? 1,
            'created_at' => now(),
        ]);

        return redirect()->route('inventory-logs.index')->with('success', 'تم تسجيل التعديل على المخزون.');
    }
}
