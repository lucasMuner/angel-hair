<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsModelChanges;
use App\Models\Role;
use App\Models\ModuleRole;

class Module extends Model
{
    use LogsModelChanges;

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'module_role')
            ->using(ModuleRole::class)
            ->withPivot(['can_view', 'can_create', 'can_edit', 'can_delete', 'user_id_created', 'user_id_updated'])
            ->withTimestamps();
    }
}
