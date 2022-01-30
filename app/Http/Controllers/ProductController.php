<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $productInstance = new Product();
        $products = $productInstance->orderProducts($request->get('order_by'));
        if ($request->ajax()) {
            return response()->json($products, 200);
        }
        
        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $reviews = $product->productReviews()->get();
        $star = $reviews->avg('rating');
        return view('products.show', [
            'product' => $product,
            'reviews' => $reviews,
            'star' => $star,
        ]);
    }
}
