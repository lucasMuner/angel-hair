<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsModelChanges;
use App\Models\User;

class Client extends Model
{
    use LogsModelChanges;

    protected $fillable = [
        'user_id',
        'phone',
        'birth_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
