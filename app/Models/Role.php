<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\UserFactory;

class Role extends Model
{

    protected $fillable = [
        'name',
        'description',
    ];

}
