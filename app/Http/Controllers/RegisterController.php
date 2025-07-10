<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Enums\UserRoleEnum;

class RegisterController extends Controller
{
    public function form(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
            ]);

            User::create([
                'name' => $validated['name'],
                'username' => $validated['username'], 
                'email' => $validated['email'],
                'password' => $validated['password'],
                'role' => UserRoleEnum::Viewer,
            ]);

            return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan login.');
        }

        return view('auth.register');
    }
}
