<?php

namespace App\Livewire;

use Livewire\Component;

class SectionComponent extends Component
{
    public $sectionName;
    public $title;
    public $description;
    public $titleColor1;
    public $titleColor2;


    public function mount($sectionName, $title, $description, $titleColor1 = 'text-black', $titleColor2 = 'text-sky-600')
    {
        $this->sectionName = $sectionName;
        $this->title = $title;
        $this->description = $description;
        $this->titleColor1 = $titleColor1;
        $this->titleColor2 = $titleColor2;
    }

    public function render()
    {
        return view('livewire.section-component');
    }
}
