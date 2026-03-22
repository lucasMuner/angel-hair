<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsModelChanges;
use App\Models\User;

class Client extends Model
{
    use LogsModelChanges;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
