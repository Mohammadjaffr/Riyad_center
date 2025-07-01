<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_variant extends Model
{
    protected $fillable = ['product_id', 'size', 'color','quantity', 'cost_price', 'sell_price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function inventoryLogs()
    {
        return $this->hasMany(InventoryLog::class);
    }

    public function getCurrentStockAttribute()
    {
        return $this->inventoryLogs->sum(function ($log) {
            switch ($log->change_type) {
                case 'شراء': return $log->quantity;
                case 'بيع': return -$log->quantity;
                case 'مرتجع شراء': return -$log->quantity;
                case 'مرتجع بيع': return $log->quantity;
                default: return $log->quantity; // تعديل يدوي
            }
        });
    }
}
