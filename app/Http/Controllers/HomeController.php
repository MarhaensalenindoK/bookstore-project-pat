<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $userRole = Auth::user()->level;
        $profile = Setting::first();
        
        return view('bookStore')
        ->with('userRole', $userRole)
        ->with('profile', $profile);
    }
}
