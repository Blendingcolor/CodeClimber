<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SubModulo extends Component
{
    public $subModuleName;

    public $subModuleId;

    public function __construct($subModuleName, $subModuleId=null)
    {
        $this->subModuleName = $subModuleName;
        $this->subModuleId = $subModuleId;
    }

    public function render()
    {
        return view('components.submodule');
    }
}
