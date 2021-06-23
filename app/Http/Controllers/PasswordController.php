<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function changePassword(){
        $userRole = Auth::user()->level;
        
        return view('shared.change_password')
        ->with('userRole', $userRole)
        ->with('page', 'PASSWORD');
    }

    public function updatePassword(Request $request){
        $request->validate([
            'old_password'=>'required|min:5|max:100',
            'new_password'=>'required|min:5|max:100',
            'confirm_password'=>'required|same:new_password'
        ]);

        $current_user= auth()->user();
        
        if(Hash::check($request->old_password, $current_user->password)){

            $current_user->update([
                'password'=>bcrypt($request->new_password)
            ]);

            return back()->with('success', 'Password successfully updated.');
            
        }else{
            return redirect()->back()->with('failed','Old password does not matched.');
        }
    }
}
