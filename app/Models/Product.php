<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'model_num', 'product_image', 'description', 'quantity', 'cost_price', 'sell_price', 'department_id'];

    public function department() { return $this->belongsTo(Department::class); }
    public function purchaseItems() { return $this->hasMany(PurchaseItem::class); }
    public function saleItems() { return $this->hasMany(SaleItem::class); }
    public function inventoryLogs() { return $this->hasMany(InventoryLog::class); }
    public function invoiceItems() { return $this->hasMany(InvoiceItem::class); }
}
