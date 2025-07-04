<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\InventoryLog;
use App\Models\Product_variant;
use Illuminate\Http\Request;

class StockAdjustmentController extends Controller
{
    public function index()
    {
        $logs = InventoryLog::where('change_type', 'جرد')->latest()->with('productVariant.product')->paginate(20);
        return view('stock_adjustments.index', compact('logs'));
    }

    public function create()
    {
        $products = Product::all();
        return view('stock_adjustments.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_variant_id' => 'required|exists:product_variants,id',
            'new_quantity' => 'required|integer|min:0',
            'description' => 'nullable|string|max:255',
        ]);

        $product = Product_variant::findOrFail($request->product_variant_id);
        $old_quantity = $product->quantity;
        $new_quantity = $request->new_quantity;
        $difference = $new_quantity - $old_quantity;

        if ($difference == 0) {
            return back()->with('info', 'لم يتم تغيير الكمية.');
        }

        $product->update(['quantity' => $new_quantity]);

        InventoryLog::create([
            'product_variant_id' => $product->id,
            'change_type' => 'جرد',
            'quantity' => $difference,
            'description' => $request->description ?? 'تعديل يدوي في الجرد',
            'created_by' => auth()->id(),
            'created_at' => now(),
        ]);

        return redirect()->route('stock-adjustments.index')->with('success', 'تم تحديث الجرد بنجاح.');
    }
}
