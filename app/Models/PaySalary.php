<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaySalary extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'date',
        'paid_amount',
        'advance_salary',
        'due_salary',
    ];

    protected $guarded = [
        'id',
    ];

    protected $with = ['employee'];

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
