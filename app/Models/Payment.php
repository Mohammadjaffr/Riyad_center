<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['invoice_id', 'amount', 'payment_date', 'payment_method', 'notes', 'created_by', 'created_at'];

    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }
    public function creator() {
        return $this->belongsTo(Employee::class, 'created_by');
    }
}
