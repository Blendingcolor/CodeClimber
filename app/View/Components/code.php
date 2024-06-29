<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class code extends Component
{
    public $sectionCode;
    public function __construct($sectionCode = null)
    {
        $this->sectionCode = $sectionCode;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sections.code');
    }
}
