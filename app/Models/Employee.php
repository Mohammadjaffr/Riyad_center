<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Mehradsadeghi\FilterQueryString\FilterQueryString;
use Spatie\Permission\Traits\HasRoles;

class Employee extends  Authenticatable
{
    use HasFactory,FilterQueryString,HasRoles,Notifiable;
    protected $guard_name = 'employee';

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }


    protected $fillable = ['name', 'phone', 'password', 'status', 'roles_name', 'salary', 'department_id'];


    protected $filters = ['sort'];

    public function department() { return $this->belongsTo(Department::class); }
    public function purchases() { return $this->hasMany(Purchase::class, 'created_by'); }
    public function sales() { return $this->hasMany(Sale::class, 'created_by'); }
    public function inventoryLogs() { return $this->hasMany(InventoryLog::class, 'created_by'); }
    public function salaries() { return $this->hasMany(EmployeeSalary::class); }
    public function advancePayments() { return $this->hasMany(EmployeeAdvancePayment::class); }
    public function createdAdvancePayments() { return $this->hasMany(EmployeeAdvancePayment::class, 'created_by'); }
    public function invoices() { return $this->hasMany(Invoice::class); }
    public function payments() { return $this->hasMany(Payment::class, 'created_by'); }
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'roles_name' => 'array',

        ];
    }
}
