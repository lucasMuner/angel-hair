<?php

namespace App\Services;

use App\Models\Module;
use App\Contracts\ModuleServiceInterface;

class ModuleService implements ModuleServiceInterface
{

    /**
     * Search modules by id
     */
    public function find(int $moduleId): ?Module
    {
        return Module::find($moduleId);
    }

    /**
     * List all modules with their associated data
     */
    public function all()
    {
        return Module::all();
    }
}
