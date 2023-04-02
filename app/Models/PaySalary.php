<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class PaySalary extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'employee_id',
        'date',
        'paid_amount',
        'advance_salary',
        'due_salary',
    ];

    public $sortable = [
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

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->whereHas('employee', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        });
    }
}
