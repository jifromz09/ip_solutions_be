<?php

namespace App\Interfaces;

use App\Services\IPAddress\Models\IpAddress;
use Illuminate\Support\Collection;


interface IPAddressRepositoryInterface 
{
    public function all(): Collection;

    public function create(array $attributes): IpAddress;

    public function findById(int $id): ?IpAddress;

    public function update(int $id, string $label): ?IpAddress;
}