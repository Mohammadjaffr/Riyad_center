<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['supplier_id', 'created_by', 'total_amount', 'purchase_date', 'notes'];

    public function supplier() { return $this->belongsTo(Supplier::class); }
    public function creator() { return $this->belongsTo(Employee::class, 'created_by'); }
    public function items() { return $this->hasMany(PurchaseItem::class); }
}
