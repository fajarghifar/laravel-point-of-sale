<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Attendence extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'employee_id',
        'date',
        'status',
    ];

    public $sortable = [
        'employee_id',
        'date',
        'status',
    ];

    protected $guarded = [
        'id'
    ];

    protected $with = [
        'employee',
    ];

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function getRouteKeyName()
    {
        return 'date';
    }
}
