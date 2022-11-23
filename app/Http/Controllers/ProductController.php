<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use App\Models\Tag;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function index()
    {
        // eager load the tags together with the products
        return view('products.index', [
            'products' => Product::with('tags')->get()
        ]);
    }

    public function new(CreateProductRequest $request, ProductService $productService)
    {
        $productData = $request->validated();
        $tags = array_unique(explode(',', $request->tags));

        $productService->create($productData, $tags);

        return redirect(route('products.index'))->with('status', 'Product named '.$productData['name'].' is saved');
    }

    public function delete(Product $product, ProductService $productService)
    {
        $productService->delete($product);

        return redirect(route('products.index'))->with('status', 'Product was deleted');
    }

    public function removeTag(Product $product, Tag $tag, ProductService $productService)
    {
        $productService->detachTag($product, $tag);

        return redirect(route('products.index'));
    }
}
