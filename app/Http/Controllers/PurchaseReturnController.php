<?php
namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Product;
use App\Models\InventoryLog;
use Illuminate\Http\Request;

class PurchaseReturnController extends Controller
{
    public function index()
    {
        $logs = InventoryLog::where('change_type', 'مرتجع شراء')->latest()->with('product')->paginate(20);
        return view('purchase_returns.index', compact('logs'));
    }

    public function create()
    {
        $purchases = Purchase::with('items.product')->get();
        return view('purchase_returns.create', compact('purchases'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'purchase_item_id' => 'required|exists:purchase_items,id',
            'return_quantity' => 'required|integer|min:1',
            'reason' => 'nullable|string|max:255',
        ]);

        $item = PurchaseItem::findOrFail($request->purchase_item_id);
        $product = Product::findOrFail($item->product_id);

        if ($request->return_quantity > $item->quantity) {
            return back()->withErrors(['return_quantity' => 'لا يمكن إرجاع كمية أكبر من المشتراة.']);
        }

        // تقليل الكمية
        if ($product->quantity < $request->return_quantity) {
            return back()->withErrors(['return_quantity' => 'لا توجد كمية كافية في المخزون لإرجاعها.']);
        }

        $product->decrement('quantity', $request->return_quantity);

        InventoryLog::create([
            'product_id' => $product->id,
            'change_type' => 'مرتجع شراء',
            'quantity' => -$request->return_quantity,
            'description' => $request->reason ?? 'إرجاع من عملية شراء #' . $item->purchase_id,
            'created_by' => auth()->id(),
            'created_at' => now(),
        ]);

        return redirect()->route('purchase-returns.index')->with('success', 'تم تسجيل مرتجع الشراء بنجاح.');
    }
}
