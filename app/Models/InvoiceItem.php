<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = [
        'invoice_id', 'product_id', 'product_variant_id', 'quantity',
        'unit_price', 'total_price'
    ];
    public function invoice() { return $this->belongsTo(Invoice::class); }
    public function productVariant()
    {
        return $this->belongsTo(Product_variant::class, 'product_variant_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
