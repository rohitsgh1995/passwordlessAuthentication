<?php

namespace App\Auth\Traits;

use App\Models\UserToken;

trait LinkAuthenticable
{
    public function token()
    {
        return $this->hasOne(UserToken::class);
    }
}