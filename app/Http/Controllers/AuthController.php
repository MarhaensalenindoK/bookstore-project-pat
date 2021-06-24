<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth/login');
    }
    
    public function login (Request $req)
    {
        $req->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $req->username, 'password' => $req->password])) {
            $user = Auth::user();
            if ($user->level === 'admin') {
                return redirect()->intended('admin');
            } elseif ($user->level === 'kasir') {
                return redirect()->intended('kasir');
            } elseif ($user->level === 'manager') {
                return redirect()->intended('home');
            } else {
                return redirect()->intended('login')->with(['error' => 'Gagal login!!']);
            }
        }

        return redirect('login')->with(['error' => 'Gagal login!!']);
    }

    public function logout (Request $req)
    {
        $req->session()->flush();
        Auth::logout();
        return redirect('login');
    }

}
