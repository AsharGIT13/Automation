<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryContrller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allsubcat = Subcategory::where('status', 0)->get();
        $categories = Category::where('status', 0)->get();

        $categories1 = Category::with('sub_category')->get()->toArray();
        $sub_cat = $categories1;
        //dd($sub_cat);
        return view('admin.subcategory', compact('categories', 'allsubcat', 'categories1'));
    }

    public function fetch(Request $request)
    {
        $categoryId = $request->input('category_id');
        $category = Subcategory::find($categoryId);
        if (!$category) {
            return response()->json(['error' => 'SubCategory not found'], 404);
        }
        return response()->json($category);
    }


    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required|unique:subcategories,subcategory_name,NULL,id,status,0',
        ]);

        $data = $request->except('_token');
        Subcategory::create($data);
        return redirect()->route('subcategory')->withMessage('Sub Category created Successfully');
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();
        $cats = Subcategory::find($id);
        $cats->update($data);
        return redirect()->route('subcategory')->withMessage('Sub Category Updated Successfully');
    }


    public function destroy(Subcategory $subcat)
    {
        $subcat->update(['status' => '1']);
        return redirect()->route('subcategory')->withMessage('Sub Category Deleted Successfully');
    }
}
