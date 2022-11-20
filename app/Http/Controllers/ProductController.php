<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index', [
            'products' => Product::all()
        ]);
    }

    public function new(Request $request, ProductService $productService)
    {
        $validated = $request->validate([
            'name' => 'required|alpha_dash|unique:products|min:3|max:64',
            'description' => 'max:255'
        ]);
        $productService->create($validated);

        return redirect(route('products.index'))->with('status', 'Product saved');
    }

    public function delete(Product $product, ProductService $productService)
    {
        $productService->delete($product);

        return redirect(route('products.index'))->with('status', 'Product was deleted');
    }
}
