<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modulo extends Component
{
    public $moduleId;
    public $moduleName;
    public $subModuleNames;
    public $subModuleIds;


    public function __construct($moduleId, $moduleName, $subModuleNames,$subModuleIds=null)
    {
        $this->moduleId = $moduleId;
        $this->moduleName = $moduleName;
        $this->subModuleNames = $subModuleNames;
        $this->subModuleIds = $subModuleIds;
    }

    public function render()
    {
        return view('components.module');
    }
}
