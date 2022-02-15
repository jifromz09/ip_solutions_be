<?php

namespace App\Interfaces;

use App\Services\User\Models\User;
use Illuminate\Support\Collection;


interface UserRepositoryInterface 
{
    // public function all(): Collection;

    public function create(array $attributes): User;

    public function findById(int $id): User;

     
}