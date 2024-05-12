<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Authcontroller extends Controller
{
  public function Authentication()
  {
    return view('admin.login');
  }

  public function userlogin(Request $request)
  {
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
        $users = User::find($user->id);
        $userdata = User::find($user->role_type);
        $assigned_menus = Role::with('menus','menuItems')->where('id', $user->role_type)->get();
        Session::put('assigned_menus', $assigned_menus[0]);
        return redirect()->route('dashboard');
      } else {
        Auth::logout();
        return redirect()->route('Authentication')->withMessage("Your account is not approved for login.");
      }
    }

    dd("login failure");
  }

  public function logout()
  {
    Session::flush();
    Auth::logout();
    return redirect('/');
  }
}
