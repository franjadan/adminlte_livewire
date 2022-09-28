<?php

namespace App\View\Components;

use Illuminate\View\Component;

class sort extends Component
{

    public $label, $field, $sort, $direction;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $field, $sort, $direction)
    {
        $this->label = $label;
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
