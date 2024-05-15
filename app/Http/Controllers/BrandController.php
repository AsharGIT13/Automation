<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $allbrand = Brand::where('status', 0)->get();
        return view('admin.brand',compact('allbrand'));
    }

    
    public function fetch(Request $request)
    {
      $brandId = $request->input('brand_id');

      $brand = Brand::find($brandId);
  
      if (!$brand) {
          return response()->json(['error' => 'Brand not found'], 404);
      }
  

      return response()->json($brand);
    }

    
    public function store(Request $request)
    {
      $request->validate([
        'brand_name' => 'required|unique:brands,brand_name,NULL,id,status,0'
      ],[
        'brand_name.unique' => 'Brand name Alreday Exist!'
      ]
    );

      $data=$request->except('_token');
      Brand::create($data);
      return redirect()->route('brand')->withMessage('Brand created Successfully');
    }

   

   
    public function update(Request $request, $id)
    {
     
    $data=$request->all();
    $cats= Brand::find($id);
    $cats->update($data);
    return redirect()->route('brand')->withMessage('Brand Updated Successfully');
    }

    public function destroy(Brand $brand)
    {
       $brand->update(['status' => '1']);
       return redirect()->route('brand')->withMessage('Brand Deleted Successfully');
 
    }
}
