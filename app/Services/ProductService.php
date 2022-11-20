<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function create(array $productData)
    {
        $product = Product::create($productData);

        return $product;
    }

    public function delete(Product $product)
    {
        $product->delete();
    }
}
