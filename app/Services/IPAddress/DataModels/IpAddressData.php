<?php

namespace App\Services\IpAddress\DataModels;

use Illuminate\Support\Facades\Auth;

class IpAddressData
{
    public function __construct(
        public string $label,
        public string $ip_address,
    ){}

    public static function mapIpAddressData(array $attributes): self 
    {
        return new static(
            label: $attributes["label"],
            ip_address: $attributes["ip_address"],
        );
    }
}