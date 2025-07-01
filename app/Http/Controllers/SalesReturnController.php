<?php
namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Models\InventoryLog;
use Illuminate\Http\Request;

class SalesReturnController extends Controller
{
    public function index()
    {
        $logs = InventoryLog::where('change_type', 'مرتجع بيع')->latest()->with('product')->paginate(20);
        return view('sales_returns.index', compact('logs'));
    }

    public function create()
    {
        $invoices = Invoice::with('items.product')->get();
        return view('sales_returns.create', compact('invoices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice_item_id' => 'required|exists:invoice_items,id',
            'return_quantity' => 'required|integer|min:1',
            'reason' => 'nullable|string|max:255',
        ]);

        $item = InvoiceItem::findOrFail($request->invoice_item_id);
        $product = Product::findOrFail($item->product_id);

        if ($request->return_quantity > $item->quantity) {
            return back()->withErrors(['return_quantity' => 'لا يمكن إرجاع كمية أكبر من المباعة.']);
        }

        // زيادة الكمية
        $product->increment('quantity', $request->return_quantity);

        // تسجيل المرتجع في سجل المخزون
        InventoryLog::create([
            'product_id' => $product->id,
            'change_type' => 'مرتجع بيع',
            'quantity' => $request->return_quantity,
            'description' => $request->reason ?? 'إرجاع منتج من الفاتورة #' . $item->invoice_id,
            'created_by' => auth()->id(),
            'created_at' => now(),
        ]);

        return redirect()->route('sales-returns.index')->with('success', 'تم تسجيل المرتجع بنجاح.');
    }
}
