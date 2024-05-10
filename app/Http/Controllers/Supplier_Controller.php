<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class Supplier_Controller extends Controller
{
    public function fetch_suppplier(){

        //$suppliers = Supplier::where('role_type', 2)->get();
      $suppliers = Supplier::where('role_type', 2)
       ->orderBy('id', 'desc') 
       ->paginate(10); 
       return view('admin.supplier', compact('suppliers')); 
    }

    public function approve(Request $request)
{
    $supid=$request->post('id');
    $supplier = Supplier::findOrFail($supid);

    // Update the approved_status to 1
    $supplier->update(['approved_status' => 1]);

    // Return a response (optional)
    return response()->json(['message' => 'Supplier approved successfully']);
}

public function denied(Request $request)
{
    $supid=$request->post('id');
    $supplier = Supplier::findOrFail($supid);

    // Update the approved_status to 1
    $supplier->update(['approved_status' => 0]);

    // Return a response (optional)
    return response()->json(['message' => 'Supplier Denied successfully']);
}

}
