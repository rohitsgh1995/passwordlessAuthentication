<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Auth\LinkAuthentication;

class PasswordLessController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function sendToken(Request $request, LinkAuthentication $auth)
    {
        $this->validateLogin($request);

        $auth->requestLink();

        return redirect()->route('login')->with('link-success', "Great. Thanks, We'ev sent you a link to Login. Please check your email and click the link.");
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255'
        ]);
    }

    public function validateToken()
    {
        
    }
}
