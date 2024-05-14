<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class Category_Controller extends Controller
{
   
    public function index()
    {
        return view('admin.category');
    }

   
    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
      $request->validate([
        'category_name' => 'required |unique:categories,category_name'
      ],[
        'category_name.unique' => 'Category name Alreday Exist!'
      ]
    );

      $data=$request->except('_token');
      Category::create($data);
      return redirect()->route('category')->withMessage('Category created Successfully');
    }

   
    public function show($id)
    {
      
    }

   
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
