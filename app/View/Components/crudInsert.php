<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class crudInsert extends Component
{
    public $formRoute;
    public function __construct($formRoute)
    {
        $this->formRoute = $formRoute;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.crudInsert');
    }
}
