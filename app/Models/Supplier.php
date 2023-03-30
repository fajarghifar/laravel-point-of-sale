<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'shopname',
        'photo',
        'type',
        'account_holder',
        'account_number',
        'bank_name',
        'bank_branch',
        'city',
    ];
    public $sortable = [
        'name',
        'email',
        'phone',
        'shopname',
        'type',
        'city',
    ];

    protected $guarded = [
        'id',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')->orWhere('shopname', 'like', '%' . $search . '%');
        });
    }
}
