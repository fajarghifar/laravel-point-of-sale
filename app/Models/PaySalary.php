<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaySalary extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'employee_id',
        'date',
        'paid_amount',
        'advance_salary',
        'due_salary',
        'salary_month',
    ];

    // protected $with = ['employee']; // REMOVED to prevent N+1 queries application-wide

    /**
     * Get the employee associated with the salary payment.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    /**
     * Scope a query to search by employee name.
     */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->whereHas('employee', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        });
    }
}
