<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class crudHeaders extends Component
{
    public $nombreHeader;
    public function __construct($nombreHeader)
    {
        $this->nombreHeader = $nombreHeader;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.crudHeader');
    }
}
