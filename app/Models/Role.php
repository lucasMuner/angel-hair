<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\UserFactory;
use App\Traits\LogsModelChanges;

class Role extends Model
{

    use LogsModelChanges;

    protected $fillable = [
        'name',
        'description',
    ];

}
