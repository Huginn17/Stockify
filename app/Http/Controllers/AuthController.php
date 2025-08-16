<?php

namespace App\Http\Controllers;

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


        if (Auth::attempt($infologin)) {
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
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
