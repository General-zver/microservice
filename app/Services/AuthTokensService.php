<?php

namespace App\Services;

use App\Models\AuthToken;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class AuthTokensService
{
    public const SECRET_PREFIX = "string-secret-prefix-key";
    public const SECRET_POSTFIX = "string-secret-postfix-key";
    public function generateToken(User $user) : string {
        Str::uuid();
        $now = now()->timestamp;
        $token = Crypt::encrypt(self::SECRET_PREFIX . "-{$user->email}-{$now}-" . self::SECRET_POSTFIX);
        $user->authTokens()->delete();
        AuthToken::create([
            'user_id' => $user->id,
            'token'   => $token,
        ]);
        return $token;
    }

    public function checkToken(string $token) : bool {
        $token_entity = AuthToken::where('token', $token)->first();
        return $token_entity?->updated_at > now()->subDay();
    }
}
