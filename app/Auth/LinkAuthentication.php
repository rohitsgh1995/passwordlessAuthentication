<?php

namespace App\Auth;

use App\Models\User;
use Illuminate\Http\Request;

class LinkAuthentication
{
    protected $request;

    protected $identifier = 'email';

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function requestLink()
    {
        $user = $this->getUserByIdentifier($this->request->get($this->identifier));

        // dd($user);
    }

    public function getUserByIdentifier($value)
    {
        return User::where($this->identifier, $value)->firstOrFail();
    }
}