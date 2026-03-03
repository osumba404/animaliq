<?php

namespace App\Http\Controllers;

use App\Models\Product;

class StoreController extends Controller
{
    public function index()
    {
        $products = Product::active()->paginate(12);

        return view('public.store.index', compact('products'));
    }

    public function show(Product $product)
    {
        if ($product->status !== 'active') {
            abort(404);
        }

        return view('public.store.show', compact('product'));
    }
}
