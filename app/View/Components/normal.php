<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class normal extends Component
{
    public $sectionId;
    public $sectionName;
    public $sectionContent;
    public $sectionImage;
    public function __construct($sectionId,$sectionName, $sectionContent, $sectionImage=null)
    {
        $this->sectionId = $sectionId;
        $this->sectionName = $sectionName;
        $this->sectionContent = $sectionContent;
        $this->sectionImage = $sectionImage;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sections.normal');
    }
}
