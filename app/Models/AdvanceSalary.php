<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class AdvanceSalary extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'employee_id',
        'date',
        'advance_salary',
    ];
    public $sortable = [
        'employee_id',
        'date',
        'advance_salary',
    ];

    protected $guarded = [
        'id',
    ];

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
