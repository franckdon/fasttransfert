<?php

namespace App\Livewire;

use App\Models\Demande;
use App\Models\User;
use App\Notifications\StatusChanged;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class UpdateStatusPopup extends Component
{
    public $demande;
    public $status;
    public $commentaire;
    public $open = false; // Ajouter cette ligne pour gérer l'état du modal

    protected $rules = [
        'status' => 'required|string',
        'commentaire' => 'required|string',
    ];

    public function mount(Demande $demande)
    {
        $this->demande = $demande;
        $this->status = $demande->historiques->last()->status ?? '';
        $this->commentaire = $demande->historiques->last()->commentaire ?? '';
    }

    public function updateStatus(Demande $demande)
    {
        $this->validate();

        $this->demande->historiques()->create([
            'status' => $this->status,
            'commentaire' => $this->commentaire,
        ]);

        $this->demande->update(['status' => $this->status]);

        $demandeur = User::find($this->demande->demandeur->id);
        Notification::send($demandeur, new StatusChanged($this->demande));

        $this->open = false;
    }

    public function render()
    {
        return view('livewire.update-status-popup');
    }
}
