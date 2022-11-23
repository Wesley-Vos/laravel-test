<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{

    /**
     * The type of the card
     *  either default (which is default) or warning
     *
     * @var string
     */
    public $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type='default')
    {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.card');
    }
}
