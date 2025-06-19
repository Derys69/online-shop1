<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function form(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'username' => ['required'], 
                'password' => ['required'],
            ]);

            if (Auth::attempt([
                'username' => $request->username, 
                'password' => $request->password,
            ])) {
                $request->session()->regenerate();
                return redirect()->route('home');
            }

            return back()->withErrors([
                'alert' => 'Username atau password yang Anda berikan tidak cocok',
            ])->onlyInput('username');
        }

        return view('auth.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken(); 
        return redirect()->route('login'); 
    }
}
