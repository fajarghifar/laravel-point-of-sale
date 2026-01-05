<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvanceSalary extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'date',
        'advance_salary',
        'is_deducted',
    ];

    /**
     * Get the employee that owns the advance salary.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    /**
     * Scope a query to only include advance salaries that have not been deducted yet.
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_deducted', false);
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
