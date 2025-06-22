<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function suppliers() { return $this->hasMany(Supplier::class); }
    public function products() { return $this->hasMany(Product::class); }
    public function sales() { return $this->hasMany(Sale::class); }
    public function invoices() { return $this->hasMany(Invoice::class); }
}
