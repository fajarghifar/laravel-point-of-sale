<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    // protected $table = 'attendances'; // Table name is implicitly 'attendances'

    protected $guarded = ['id'];

    protected $fillable = [
        'employee_id',
        'date',
        'status',
    ];

    // protected $with = ['employee']; // Global eager loading removed for optimization

    /**
     * Get the employee that owns the attendance.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'date';
    }
}
