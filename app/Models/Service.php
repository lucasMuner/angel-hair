<?php

namespace App\Models;

use App\Traits\LogsModelChanges;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Service extends Model
{
    use LogsModelChanges;

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'image',
        'status'
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class,  'employees_services');
    }

}
