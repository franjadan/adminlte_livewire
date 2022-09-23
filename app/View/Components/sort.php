<?php

namespace App\View\Components;

use Illuminate\View\Component;

class sort extends Component
{

    public $field, $sort, $direction;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($field, $sort, $direction)
    {
        $this->field = $field;
        $this->sort = $sort;
        $this->direction = $direction;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sort');
    }
}
