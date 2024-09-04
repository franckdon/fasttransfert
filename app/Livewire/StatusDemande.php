<?php

namespace App\Livewire;

use App\Models\Demande;
use Livewire\Component;

class StatusDemande extends Component
{
    public $demande;

    public function mount(Demande $demande)
    {
        $this->demande = $demande;
    }

    public function render()
    {
        $latestHistory = $this->demande->historiques->last();
        return view('livewire.status-demande', [
            'status' => $latestHistory ? $latestHistory->status : 'N/A',
        ]);
    }
}
