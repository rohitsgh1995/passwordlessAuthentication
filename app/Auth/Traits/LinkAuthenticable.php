<?php

namespace App\Auth\Traits;

use Mail;
use App\Models\UserToken;
use App\Mail\MailLinkToUser;
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

    public function sendLink(array $options)
    {
        Mail::to($this)->send(new MailLinkToUser($this, $options));
    }

    public function token()
    {
        return $this->hasOne(UserToken::class);
    }
}