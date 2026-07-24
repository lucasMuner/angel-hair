<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ModuleRole extends Pivot
{
    protected $table = 'module_role';

    protected $fillable = [
        'role_id',
        'module_id',
        'can_view',
        'can_create',
        'can_edit',
        'can_delete',
        'user_id_created',
        'user_id_updated',
    ];

    protected $casts = [
        'can_view'   => 'boolean',
        'can_create' => 'boolean',
        'can_edit'   => 'boolean',
        'can_delete' => 'boolean',
    ];
}
