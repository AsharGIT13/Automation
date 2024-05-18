<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {

        return view('products.index');
    }

    public function get_product_list(Request $request)
    {
        $user_id = auth()->user()->id;
        $limit_val = $request->input('length');
        $start = $request->input('start');
        $searchText = $request->input('search.value');
        $query = Product::where('products.status', 1)
            ->join('categories AS c', 'products.category_id', '=', 'c.id')
            ->join('brands AS b', 'products.brand_id', '=', 'b.id')
            ->join('subcategories AS s', 'products.sub_category_id', '=', 's.id')
            ->select(
                'products.id AS id',
                'products.name AS product_name',
                'products.weight AS product_weight',
                'products.price AS product_price',
                'products.description AS product_description',
                'products.specification AS product_specification',
                'c.category_name AS category_name',
                'b.brand_name AS brand_name',
                's.subcategory_name AS subcategory_name',
            );

        if (!empty($searchText)) {
            $query->where(function ($q) use ($searchText) {
                $q->where('products.name', 'LIKE', "%{$searchText}%")
                    ->orWhere('products.weight', 'LIKE', "%{$searchText}%")
                    ->orWhere('products.price', 'LIKE', "%{$searchText}%")
                    ->orWhere('products.description', 'LIKE', "%{$searchText}%")
                    ->orWhere('products.specification', 'LIKE', "%{$searchText}%");
            });
        }

        $totalDataRecord = $query->count();

        $orderColumnIndex = $request->input('order.0.column');
        $orderColumnName = $request->input('columns.' . $orderColumnIndex . '.data');
        $orderDirection = $request->input('order.0.dir');
        if ($orderColumnName && in_array($orderDirection, ['asc', 'desc'])) {
            $query->orderBy('id', $orderDirection);
        }

        // Pagination
        if ($limit_val != -1) { // Check if 'All' records are requested
            $post_data = $query->offset($start)->limit($limit_val)->get();
        } else {
            $post_data = $query->get();
        }
        foreach ($post_data  as $index =>  $data) {
            $serialNumber = $start + $index + 1;
            $edit_driver = '<a href="' . route('edit_product', ['id' => $data->id]) . '"><i class="far fa-edit"></i></a>';
            $delete_driver = '<a href="' . route('delete_product', ['id' => $data->id]) . '"><i class="far fa-trash-alt"></i></a>';
            $array_data[] = array(
                'S No' => $serialNumber,
                'id' => $data->id,
                'product_name' => $data->product_name,
                'product_weight' => $data->product_weight,
                'product_price' => $data->product_price,
                'product_description' => $data->product_description,
                'product_specification' => $data->product_specification,
                'category_name' => $data->category_name,
                'brand_name' => $data->brand_name,
                'subcategory_name' => $data->subcategory_name,
                'action' => $edit_driver . '   ' . $delete_driver
            );
        }

        if (!empty($array_data)) {
            $draw_val = $request->input('draw');
            $get_json_data = array(
                "draw"            => intval($draw_val),
                "recordsTotal"    => intval($totalDataRecord),
                "recordsFiltered" => intval($totalDataRecord),
                "data"            => $array_data
            );

            echo json_encode($get_json_data);
        } else {
            $draw_val = $request->input('draw');
            $get_json_data = array(
                "draw"            => "intval($draw_val)",
                "recordsTotal"    => 0,
                "recordsFiltered" => 0,
                "data"            => ""
            );
            echo json_encode($get_json_data);
        }
    }

    public function create()
    {
        $categoriesdata = Category::where('status', 0)->get();
        $branddata = Brand::where('status', 0)->get();
        return view('products.create', compact('categoriesdata', 'branddata'));
    }

    public function get_subcat(Request $request)
    {
        $category_id = $request->post('category_id');
        $results = Subcategory::where('category_id', '=', $category_id)->get();
        if (empty($results)) {
            return response(["success" => false, "message" => "No Data Found"]);
        } else {
            return response(["success" => true, "data" => $results]);
        }
    }
    public function store_product(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'brand' => 'required',
            'category'  => 'required',
            'subcategory'  => 'required',
            'price'  => 'required|numeric',
            'weight'  => 'numeric',
            'proimage' => 'file|mimes:pdf,jpeg,png|max:25600',
        ]);

        if ($validator->fails()) {
            return response([
                "success" => 'validation',
                "message" => $validator->errors()
            ]);
        }
        $proimage = "";
        if ($request->hasFile('proimage')) {
            $file = $request->file('proimage');
            $proimage =  time() . '_proimage_' . $file->getClientOriginalName();
            $file->move(public_path('build/product_images'), $proimage);
        }

        try {

            $data = Product::insert([
                'name' => $request->post('name'),
                'brand_id' => $request->post('brand'),
                'category_id' => $request->post('category'),
                'sub_category_id' => $request->post('subcategory'),
                'weight' => $request->post('weight'),
                'price' => $request->post('price'),
                'description' => $request->post('description'),
                'name' => $request->post('name'),
                'specification' => $request->post('specification'),
                'status' => 1,
                'product_images'  => $proimage,
            ]);

            return response(["success" => true, "message" => "Product Inserted Successfully"]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Product Insert Failed: " . $e->getMessage());
            return response([
                "success" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }
    public function edit_product(Request $request)
    {
        $id = $request->get('id');
        $data = Product::find($id);

        $product_images = $data->product_images ? Storage::url($data->product_images) : null;

        $fileInputs = [
            'product_images' => $product_images,
        ];

        $categories = Category::where('status', 0)->get();
        $subcategories = Subcategory::where('status', 0)->get();
        $brands = Brand::where('status', 0)->get();
        return view('products.edit', compact('data', 'categories', 'subcategories', 'brands', 'fileInputs'));
    }

    public function download(Request $request)
    {
        $filename = $request->get('filename');
        // Define the file path
        $filePath = public_path('build/product_images/' . $filename);
        // Return the file as a response
        if ($filePath) {
            return Response::download($filePath);
        } else {
            return false;
        }
    }

    public function update_products(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'brand' => 'required',
            'category'  => 'required',
            'subcategory'  => 'required',
            'price'  => 'required|numeric',
            'weight'  => 'numeric',
            'proimage' => 'file|mimes:pdf,jpeg,png|max:25600',
        ]);
        if ($validator->fails()) {
            return response([
                "success" => 'validation',
                "message" => $validator->errors()
            ]);
        }
        $proimage = "";
        if ($request->hasFile('proimage')) {
            $file = $request->file('proimage');
            $proimage =  time() . '_proimage_' . $file->getClientOriginalName();
            $file->move(public_path('build/product_images'), $proimage);
        } else {
            $proimage = $request->post('proimage_filename');
        }
       
        try {
            $recordToUpdate = Product::find($request->post('id'));

            $recordToUpdate->update([
                'name' => $request->post('name'),
                'brand_id' => $request->post('brand'),
                'category_id' => $request->post('category'),
                'sub_category_id' => $request->post('subcategory'),
                'weight' => $request->post('weight'),
                'price' => $request->post('price'),
                'description' => $request->post('description'),
                'name' => $request->post('name'),
                'specification' => $request->post('specification'),
                'product_images'  => $proimage,
            ]);

            return response(["success" => true, "message" => "Products Updated Successfully"]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Products Updated Failed: " . $e->getMessage());
            return response([
                "success" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }
    public function delete_product(Request $request)
    {
      $product_id = $request->get('id');
      $delete_data = Product::find($product_id);
      $delete_data->status = 0;
      $delete_data->save();
      return redirect()->route('product');
    }
}
