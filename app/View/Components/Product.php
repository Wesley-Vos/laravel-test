<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Product extends Component
{
    /**
     * The product.
     *
     * @var Product
     */
    public $product;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($product)
    {
        $this->product=$product;
    }

    /**
      * Get the view that represent the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.product');
    }
}
