<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['name', 'phone', 'address', 'department_id'];

    public function department() { return $this->belongsTo(Department::class); }
    public function purchases() { return $this->hasMany(Purchase::class); }
}
