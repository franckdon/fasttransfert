<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatsCard extends Component
{
    public $title;
    public $count;
    public $bgColor;
    public $svgIcon;

    public function __construct($title, $count, $bgColor = 'gray-500', $svgIcon = null)
    {
        $this->title = $title;
        $this->count = $count;
        $this->bgColor = $bgColor;
        $this->svgIcon = $svgIcon;
    }

    public function render()
    {
        return view('components.stats-card');
    }
}
