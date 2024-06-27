<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    public function index(Request $request)
    {
        return view('dashboard');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->withSuccess('Signed in');
        }
        return redirect("/")->withErrors(['errMsg' => 'Login details are not valid']);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect("/");
    }
}
