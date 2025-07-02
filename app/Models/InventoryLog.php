<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model
{
    protected $fillable = ['product_id', 'product_variant_id', 'change_type', 'quantity', 'description', 'created_by',  'invoice_item_id', 'created_at'];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function productVariant()
    {
        return $this->belongsTo(Product_variant::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'created_by');
    }
    public function invoiceItem()
    {
        return $this->belongsTo(InvoiceItem::class);
    }



}
