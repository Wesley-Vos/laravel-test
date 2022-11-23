<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Tag;

class ProductService
{
    /**
     * Method to create a product given the inputted data
     *
     * @param array $productData    the name and description of the product
     * @param array $tags           the array of tag names to attach to the product
     * @return Product              the created product
     */
    public function create(array $productData, array $tags)
    {
        $product = Product::create($productData);
        $this->associateTags($product, $tags);

        return $product;
    }

    /**
     * Method to associate tags with a product
     * The tag go through a validation and processing pipeline:
     *  1. trim whitespace
     *  2. convert to lowercase
     *  3. check if not empty
     *  4. create tag if it does not exist yet
     *  5. push id of tag to array
     *  6. attach unique tag array to product
     *
     * @param Product $product  the product to attach the tags to
     * @param array $tagNames   the names of the tags to attach to the product
     * @return void
     */
    public function associateTags(Product $product, array $tagNames)
    {
        // anonymous method to reduce the tag names to a list of tag ids
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
        $tag_ids = array_unique(array_reduce($tagNames, $reduceTag, []));

        $product->tags()->attach($tag_ids);
    }

    /**
     * Method to detach a tag from a product
     *
     * @param Product $product  the product
     * @param Tag $tag          the tag to remove
     * @return void
     * @throws \Exception
     */
    public function detachTag(Product $product, Tag $tag)
    {
        $product->tags()->detach($tag->id);
        $this->processTagRemoval($tag);
    }

    /**
     * Method to delete the given product and remove any
     * unused tags
     *
     * @param Product $product  the product to be delete
     * @return void
     * @throws \Exception
     */
    public function delete(Product $product)
    {
        $tags = $product->tags;
        $product->delete();
        foreach($tags as $tag)
        {
            $this->processTagRemoval($tag);
        }
    }


    /**
     * Method to clean up any unused tag after they are
     * either detached from the product or the whole product
     * is removed
     *
     * @param Tag $tag      the tag to be removed
     * @return void
     * @throws \Exception
     */
    private function processTagRemoval(Tag $tag)
    {
        if ($tag->products()->count() == 0) {
            $tag->delete();
        }
    }
}
