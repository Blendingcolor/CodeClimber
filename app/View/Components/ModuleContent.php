<?php

// namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModuleContent extends Component
{
    public $module;
    public $existingMP;
    public $course;
    /**
     * Create a new component instance.
     */
    public function __construct($module,$existingMP,$course)
    {
        $this->module=$module;
        $this->existingMP=$existingMP;
        $this->course=$course;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.moduleContent');
    }
}
