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

        $user->storeToken()->sendLink([
            'remember_me' => $this->request->has('remember'),
            'email' => $user->email
        ]);
    }

    public function getUserByIdentifier($value)
    {
        if(User::where($this->identifier, $value)->doesntExist())
        {
            $new_user = User::create([
                $this->identifier => $value
            ]);

            return $new_user;
        }
        else
        {
            return User::where($this->identifier, $value)->firstOrFail();
        }        
    }
}