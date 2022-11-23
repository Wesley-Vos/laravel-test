<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use App\Models\Tag;
use App\Services\ProductService;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Method to return a product overview populated with
     * the products from the database
     *
     * @return View
     */
    public function index()
    {
        // eager load the tags together with the products
        return view('products.index', [
            'products' => Product::with('tags')->get()
        ]);
    }

    /**
     * Method to create a new product
     *
     * @param CreateProductRequest $request     the incoming request, containing validated input
     * @param ProductService $productService    the productService used to create a product
     * @return Redirector                       redirect the user to the overview page
     */
    public function new(CreateProductRequest $request, ProductService $productService)
    {
        $productData = $request->validated();
        $tags = array_unique(explode(',', $request->tags));

        $productService->create($productData, $tags);

        return redirect(route('products.index'))->with('status', 'Product named '.$productData['name'].' is saved');
    }

    /**
     * Method to delete the given product
     *
     * @param Product $product                  the product to delete
     * @param ProductService $productService    the productService used to delete the product
     * @return Redirector                       redirect the user to the overview page
     * @throws \Exception
     */
    public function delete(Product $product, ProductService $productService)
    {
        $productService->delete($product);

        return redirect(route('products.index'))->with('status', 'Product was deleted');
    }

    /**
     * Method to remove a single tag from a product
     *
     * @param Product $product                  the product to remove the tag from
     * @param Tag $tag                          the tag to be removed
     * @param ProductService $productService    the productService used to perform the deletion
     * @return Redirector                       redirect the user to the overview page
     * @throws \Exception
     */
    public function removeTag(Product $product, Tag $tag, ProductService $productService)
    {
        $productService->detachTag($product, $tag);

        return redirect(route('products.index'));
    }
}
