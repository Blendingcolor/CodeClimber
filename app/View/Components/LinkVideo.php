<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LinkVideo extends Component
{
    public $linkVideo;

    public function __construct($linkVideo = null)
    {
        $this->linkVideo = $linkVideo;
    }

    public function render(): View|Closure|string
    {
        return view('components.linkVideo');
    }
}

