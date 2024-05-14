<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class Category_Controller extends Controller
{
   
    public function index()
    {
        $allcat = Category::all();
        return view('admin.category',compact('allcat'));
    }

    
    public function fetch(Request $request)
    {
      $categoryId = $request->input('category_id');

      $category = Category::find($categoryId);
  
      if (!$category) {
          return response()->json(['error' => 'Category not found'], 404);
      }
  

      return response()->json($category);
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

   

   
    public function update(Request $request, $id)
    {
     
    $data=$request->all();
    $cats= Category::find($id);
    $cats->update($data);
    return redirect()->route('category')->withMessage('Category Updated Successfully');
    }

    public function destroy(Category $category)
    {
       $category->delete();
       return redirect()->route('category')->withMessage('Category Deleted Successfully');
    }
}
