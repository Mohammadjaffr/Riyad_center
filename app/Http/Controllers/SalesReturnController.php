<?php
namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Models\InventoryLog;
use App\Models\Product_variant;
use Illuminate\Http\Request;

class SalesReturnController extends Controller
{
    public function index()
    {
        $logs = InventoryLog::where('change_type', 'مرتجع بيع')->latest()->with('productVariant.product')->paginate(20);
        return view('sales_returns.index', compact('logs'));
    }

    public function create()
    {
        $invoices = Invoice::with('items.productVariant.product')->get();
        return view('sales_returns.create', compact('invoices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice_item_id' => 'required|exists:invoice_items,id',
            'return_quantity' => 'required|integer|min:1',
            'reason' => 'nullable|string|max:255',
        ]);

        $item = InvoiceItem::with('productVariant')->findOrFail($request->invoice_item_id);
        $product = $item->productVariant;

        // حساب كمية المرتجعات السابقة لنفس عنصر الفاتورة
        $returnedQuantity = InventoryLog::where('change_type', 'مرتجع بيع')
            ->where('invoice_item_id', $item->id)
            ->sum('quantity');

        $availableForReturn = $item->quantity - $returnedQuantity;

        if ($request->return_quantity > $availableForReturn || $availableForReturn <= 0) {
            return back()->withErrors(['return_quantity' => 'لا يمكن إرجاع كمية أكبر من الكمية المتاحة أو لا توجد كمية متاحة للإرجاع.']);
        }

        // زيادة الكمية في المخزون
        $product->increment('quantity', $request->return_quantity);

        // تسجيل المرتجع في سجل المخزون
        InventoryLog::create([
            'invoice_item_id' => $item->id,
            'product_variant_id' => $product->id,
            'change_type' => 'مرتجع بيع',
            'quantity' => $request->return_quantity,
            'description' => $request->reason ?? 'إرجاع منتج من الفاتورة #' . $item->invoice_id,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('sales-returns.index')->with('success', 'تم تسجيل المرتجع بنجاح.');
    }
}
