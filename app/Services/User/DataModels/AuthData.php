<?php

namespace App\Services\User\DataModels;

use Illuminate\Support\Facades\Auth;

class AuthData
{
    public function __construct(
        public string $access_token,
        public string $name,
        public string $message,
        public string $token_type, 
        public int $user_id, 
    ){}

    public static function mapAuthData($user, $tokenResult): self 
    {
        return new static(
            name: $user->name,
            access_token: $tokenResult->accessToken,
            message: 'OK',
            token_type: 'Bearer',
            user_id: $user->id
        );
    }
}