<?php

namespace App\Http\Controllers;

use App\Models\Supplier as ModelsSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class supplier extends Controller
{
    public function index(){
        return view('index');
    }
    
    public function supplier_register(Request $request){

       
        $request->validate([
            'name' => 'required',
            'company_name' => 'required',
            'mobile_number' => 'required|unique:users,mobile_number',
            'email' => 'required|unique:users,email|email',
            'vat_no' => 'required|unique:users,vat_no',
            'password' => 'required|confirmed',
        ]);

        $data= $request->except('_token');
        $data['password'] = Hash::make($request->input('password'));
        $data['role_type']="2";
        //ModelsSupplier::create($data);
        
        $supplier = ModelsSupplier::create($data);


    if ($supplier) {

        return redirect()->route('success');
    } else {
        return redirect()->route('failure');
    }
  
    }

    public function registration_success(){
        return view('register_success');
    }

    public function registration_fail(){
        return view('register_fail');
    }

}
