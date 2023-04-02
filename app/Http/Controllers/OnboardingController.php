<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnboardingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->name != null || Auth::user()->name != '')
        {
            return redirect()->route('dashboard');
        }

        return view('onboarding');
    }

    public function saveName(Request $request)
    {
        $this->validateName($request);

        $update = User::where('id', Auth::user()->id)->update([
            'name' => $request->name
        ]);

        if($update)
        {
            return redirect()->route('dashboard');
        }
        else
        {
            return redirect()->route('onboarding')->with('error', 'Something went wrong. Try again!');
        }
    }

    protected function validateName(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255'
        ]);
    }
}
