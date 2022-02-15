<?php

namespace App\Services\User\DataModels;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserData
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public int $type, 
        public string $remember_token, 
    ){}

    public static function mapUserData(array $attributes): self 
    {
        return new static(
            name: $attributes["name"],
            email: $attributes["email"],
            password: bcrypt($attributes['password']),
            type: $attributes['type'] ? $attributes['type']  : 0,
            remember_token: Str::random(10)
        );
    }
}