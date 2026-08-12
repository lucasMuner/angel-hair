<?php

namespace App\Contracts;
use Illuminate\Http\UploadedFile;

interface ServiceServiceInterface
{
    public function store(array $data, ?UploadedFile $image = null);
    public function update(int $id, array $data, ?UploadedFile $image = null);
    public function delete(int $id): bool;
    public function find(int $id);
    public function all(?string $search = null, ?int $perPage = null);
}
