<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::withTrashed()->withCount('orderItems')->orderBy('name')->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'status' => 'in:active,inactive',
        ]);
        if ($request->hasFile('image')) {
            $validated['image_path'] = \App\Services\ImageService::handleUpload($request->file('image'), 'products');
        } else {
            $validated['image_path'] = null;
        }
        Product::create($validated);
        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'status' => 'in:active,inactive',
        ]);
        if ($request->hasFile('image')) {
            if ($product->image_path) {
                \App\Services\ImageService::delete($product->image_path);
            }
            $validated['image_path'] = \App\Services\ImageService::handleUpload($request->file('image'), 'products');
        } else {
            unset($validated['image_path']);
        }
        $product->update($validated);
        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        if ($product->image_path) {
            \App\Services\ImageService::delete($product->image_path);
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }
}
