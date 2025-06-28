<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeAdvancePayment extends Model
{
    protected $fillable = ['employee_id', 'amount', 'reason', 'payment_date', 'notes', 'created_by', 'created_at'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function creator()
    {
        return $this->belongsTo(Employee::class, 'created_by');
    }
}
