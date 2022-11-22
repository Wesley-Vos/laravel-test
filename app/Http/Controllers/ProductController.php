<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

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
        $productData = $request->validate([
            'name' => 'required|alpha_dash|unique:products|min:3|max:64',
            'description' => 'max:255',
        ]);
        $tags = array_unique(explode(',', $request->tags));

        $productService->create($productData, $tags);

        return redirect(route('products.index'))->with('status', 'Product named '.$productData['name'].' is saved');
    }

    public function delete(Product $product, ProductService $productService)
    {
        $productService->delete($product);

        return redirect(route('products.index'))->with('status', 'Product was deleted');
    }
}
