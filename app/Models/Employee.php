<?php

namespace App\Models;

use App\Traits\LogsModelChanges;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Employee extends Model
{

    use LogsModelChanges;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
