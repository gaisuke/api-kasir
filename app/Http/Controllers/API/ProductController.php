<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\AllProduct;
use App\Http\Resources\Product\ShowProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $data = [
            'status' => true,
            'message' => 'All product fetched successfully',
        ];
        return AllProduct::collection($products)->additional($data);
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return json_response(0, 'Product not found');
        }
        $data = [
            'status' => true,
            'message' => "$product->name fetched successfully",
        ];
        return ShowProduct::make($product)->additional($data);
    }
}
