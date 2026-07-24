<?php

namespace App\Contracts;

interface ModuleServiceInterface
{
    public function find(int $id);
    public function all();
}
