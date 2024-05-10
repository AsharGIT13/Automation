<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admincontroller extends Controller
{
    public function Homepage(){
        return view('admin.dashboard');
        
    }

    public function suppliers(){
        return view('admin.supplier');
    }


}
