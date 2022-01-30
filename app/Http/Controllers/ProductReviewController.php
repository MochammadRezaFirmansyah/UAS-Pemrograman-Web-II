<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Support\Facades\Auth;

class ProductReviewController extends Controller
{

    public function store(Product $product)
    {
        $attribute = request()->all();
        $attribute['product_id'] = $product->id;
        $attribute['user_id'] = Auth::user()->id;

        ProductReview::create($attribute);

        return back()->with('success', 'Review have been saved');
    }

    public function show(Product $product)
    {
    }
}
