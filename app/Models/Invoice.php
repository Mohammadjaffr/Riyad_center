<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['customer_name', 'department_id', 'invoice_num', 'discount_amount', 'employee_id', 'total_amount', 'paid_amount', 'rest_amount', 'payment_type', 'notes', 'invoice_date', 'created_at'];

    public function department() { return $this->belongsTo(Department::class); }
    public function employee() { return $this->belongsTo(Employee::class); }
    public function items() { return $this->hasMany(InvoiceItem::class); }
    public function payments() { return $this->hasMany(Payment::class); }
}
