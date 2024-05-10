<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authcontroller extends Controller
{
    public function Authentication(){
        return view('admin.login');
    }

    public function userlogin(Request $request) {
      $request->validate([
          'email' => 'required',
          'password' => 'required',
      ]);
      
      // Debugging line, remove it once done debugging
      // dd($request);
      
      $credentials = $request->only('email', 'password');
      
      if (Auth::attempt($credentials)) {
        // Check if the user's approved_status is 1
        $user = Auth::user();
        if ($user->approved_status == 1) {
          return redirect()->route('dashboard');
        } else { 
            Auth::logout();
            return redirect()->route('Authentication')->withMessage("Your account is not approved for login.");
        }
    }
      
      dd("login failure");
  }

  public function logout(){
    Auth::logout();
    return redirect()->route('Authentication');
  }
  
}
