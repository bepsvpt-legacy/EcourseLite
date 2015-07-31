<?php

namespace App\Http\Controllers;

use App\Ecourse\Authenticate;
use App\Http\Requests\SignInRequest;

class AuthController extends Controller
{
    public function signIn()
    {
        clearSession();

        return view('signIn');
    }

    public function signInAuth(SignInRequest $request)
    {
        if ((new Authenticate($request->input('username'), $request->input('password')))->check())
        {
            return redirect()->route('index');
        }

        return back()->withErrors(['formError' => 'Invalid username or password.']);
    }

    public function signOut()
    {
        clearSession();

        return redirect()->route('signIn');
    }
}