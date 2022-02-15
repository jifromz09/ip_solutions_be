<?php

namespace App\Services\User\DataModels;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class CredentialData
{
    public function __construct(
        public string $email,
        public string $password,
    ){}

    public static function mapCredentialData(Request $request): self 
    {
        return new static(
            email: $request->email,
            password: $request->password
        );
    }
}