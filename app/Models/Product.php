<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mehradsadeghi\FilterQueryString\FilterQueryString;

class Product extends Model
{
    use FilterQueryString;
    protected $fillable = ['name', 'model_num', 'product_image', 'description', 'quantity', 'cost_price', 'sell_price', 'department_id'];

    protected $filters = ['search', 'sort'];
    public function scopeSearch($query, $value)
    {
        return $query->where(function ($q) use ($value) {
            $q->where('name', 'like', "%$value%")
                ->orWhere('model_num', 'like', "%$value%");
        });
    }

    public function scopeSort($query, $value)
    {
        $direction = in_array(strtolower($value), ['asc', 'desc']) ? $value : 'asc';
        return $query->orderBy('name', $direction);
    }


    public function department() { return $this->belongsTo(Department::class); }
    public function purchaseItems() { return $this->hasMany(PurchaseItem::class); }
    public function saleItems() { return $this->hasMany(SaleItem::class); }
    public function inventoryLogs() { return $this->hasMany(InventoryLog::class); }
    public function invoiceItems() { return $this->hasMany(InvoiceItem::class); }
    public function variants()
    {
        return $this->hasMany(Product_variant::class);
    }

}
