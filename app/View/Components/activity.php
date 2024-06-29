<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class activity extends Component
{
    public $sectionId;
    public $sectionName;
    public $sectionContent;

    public function __construct($sectionId, $sectionName, $sectionContent)
    {
        $this->sectionId = $sectionId;
        $this->sectionName = $sectionName;
        $this->sectionContent = $sectionContent;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sections.activity');
    }
}
