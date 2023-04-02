<?php

namespace App\Auth\Traits;

use App\Models\UserToken;
use Illuminate\Support\Str;

trait LinkAuthenticable
{
    public function storeToken()
    {
        $this->token()->delete();

        $this->token()->create([
            'token' => Str::random(255),
        ]);

        return $this;
    }

    public function token()
    {
        return $this->hasOne(UserToken::class);
    }
}