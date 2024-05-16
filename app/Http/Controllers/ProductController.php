<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
            ->select(
                'products.id AS id',
                'products.name AS product_name',
                'products.weight AS product_weight',
                'products.price AS product_price',
                'products.description AS product_description',
                'products.specification AS product_specification'
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
            $array_data[] = array(
                'S No' => $serialNumber,
                'id' => $data->id,
                'product_name' => $data->product_name,
                'product_weight' => $data->product_weight,
                'product_price' => $data->product_price,
                'product_description' => $data->product_description,
                'product_specification' => $data->product_specification
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
        return view('products.create');
    }
}
