<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    public function new(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|alpha_dash|unique:products|min:3|max:255',
        ]);

        Product::create($validated);

        return redirect(route('products.index'))->with('status', 'Product saved');
    }

    public function delete(Product $product)
    {
        $product->delete();

        return redirect(route('products.index'))->with('status', 'Product was deleted');
    }
}
