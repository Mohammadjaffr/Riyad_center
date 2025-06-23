<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['name', 'phone', 'password', 'status', 'role', 'salary', 'department_id'];

    public function department() { return $this->belongsTo(Department::class); }
    public function purchases() { return $this->hasMany(Purchase::class, 'created_by'); }
    public function sales() { return $this->hasMany(Sale::class, 'created_by'); }
    public function inventoryLogs() { return $this->hasMany(InventoryLog::class, 'created_by'); }
    public function salaries() { return $this->hasMany(EmployeeSalary::class); }
    public function advancePayments() { return $this->hasMany(EmployeeAdvancePayment::class); }
    public function createdAdvancePayments() { return $this->hasMany(EmployeeAdvancePayment::class, 'created_by'); }
    public function invoices() { return $this->hasMany(Invoice::class); }
    public function payments() { return $this->hasMany(Payment::class, 'created_by'); }
}
