<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        DB::insert("INSERT INTO products (name) VALUES ('".$validated['name']."')");

        return redirect(route('products.index'))->with('status', 'Product saved');
    }

    public function delete(Request $request)
    {
        DB::delete("DELETE FROM products WHERE id = ".$request->id);

        return redirect(route('products.index'))->with('status', 'Product was deleted');
    }
}
