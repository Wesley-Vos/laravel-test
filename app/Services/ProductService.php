<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Tag;

class ProductService
{
    public function create(array $productData, array $tags)
    {
        $product = Product::create($productData);
        $this->associateTags($product, $tags);

        return $product;
    }

    public function associateTags(Product $product, array $tags)
    {
        $reduceTag = function(array $res, string $tag): array {
            $processedTag = strtolower(trim($tag));

            if (empty($processedTag)) {
                return $res;
            } else {
                $tag_id = Tag::firstOrCreate(["name"=>$processedTag])->id;
                return array_merge($res, [ $tag_id ]);
            }
        };

        // return all ids of unique tags, inputted by the user
        $tag_ids = array_unique(array_reduce($tags, $reduceTag, []));

        $product->tags()->attach($tag_ids);
    }

    public function detachTag(Product $product, Tag $tag)
    {
        $product->tags()->detach($tag->id);
    }

    public function delete(Product $product)
    {
        $product->delete();
    }
}
