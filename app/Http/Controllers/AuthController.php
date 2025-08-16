<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('manual-auth.login');
    }

    public function loginproses(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email Harus Diisi',
            'password.required' => 'Password Harus Diisi',
        ]);
        $infologin = [
            'email' => $request->email,
            'password' =>  $request->password
        ];

        $remember = $request->has('remember');

        if (Auth::attempt($infologin, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();
            activity_log(
                'Login',
                "User {$user->name} Login sebagai {$user->role}",
                'Auth',
                [
                    'user_id' => $user->id,
                    'role' => $user->role,
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent(),

                ]
            );
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->role == 'manajer_cabang') {
                return redirect()->route('manajer.dashboard');
            } elseif (Auth::user()->role == 'staff_gudang') {
                return redirect()->route('staff.dashboard');
            }
        } else {

            return redirect('/login')->withErrors('Email Atau Password Salah')->withInput();
        }
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            activity_log(
                'Logout',
                "User {$user->name} Logout",
                'Auth',
                [
                    'user_id' => $user->id,
                    'role' => $user->role,
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]
            );
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
