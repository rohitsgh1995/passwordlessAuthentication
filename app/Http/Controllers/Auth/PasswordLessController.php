<?php

namespace App\Http\Controllers\Auth;

use App\Models\UserToken;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Auth\LinkAuthentication;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class PasswordLessController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function sendToken(Request $request, LinkAuthentication $auth)
    {
        $this->validateLogin($request);

        $auth->requestLink();

        return redirect()->route('login')->with('link-success', "Great. Thanks, We'ev sent you a link to Login. Please check your email $request->email and click the link.");
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255'
        ]);
    }

    public function validateToken(Request $request, UserToken $token)
    {
        $token->delete();

        if($token->isExpired())
        {
            return redirect()->route('login')->with('error', 'The link has expired.');
        }

        if(!$token->belongsToEmail($request->email))
        {
            return redirect()->route('login')->with('error', 'The link is invalid.'); 
        }

        Auth::login($token->user, $request->remember_me);

        return redirect()->intended();
    }
}
