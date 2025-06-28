<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['customer_name', 'created_by', 'total_amount', 'notes', 'department_id'];

    public function employee() { return $this->belongsTo(Employee::class, 'created_by'); }
    public function department() { return $this->belongsTo(Department::class); }
    public function items() { return $this->hasMany(SaleItem::class); }
}
