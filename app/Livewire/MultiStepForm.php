<?php

namespace App\Livewire;

use App\Models\Demande;
use App\Models\Document;
use App\Models\Question;
use App\Models\Reglement;
use App\Models\User;
use App\Notifications\DemandeCreated;
use Livewire\Component;
use Livewire\WithFileUploads;

class MultiStepForm extends Component
{
    use WithFileUploads;

    public $step = 1;
    public $score = 0;
    public $reglements = [];
    public $reglementId;
    public $questions = [];
    public $files = [];
    public $demandeurId;
    public $demandeurs = [];
    public $filePaths = [];
    public $uploadedFiles = [];
    public $responses = [];


    public function mount()
    {
        $this->reglements = Reglement::all();
        $this->demandeurs = User::role('client')->get();

        if (auth()->user()->hasRole('client')) {
            $this->demandeurId = auth()->user()->id;
        }
    }

    public function updatedReglementId($value)
    {
        $this->questions = Question::where('reglement_id', $value)->get();

        $reglement = Reglement::with('documents')->find($value);
        $this->files = $reglement->documents;

        // Initialiser dynamiquement les propriétés des fichiers
        foreach ($this->files as $file) {
            $this->{'file' . $file->id} = null;
        }

        $this->responses = array_fill(0, count($this->questions), 'no');
        $this->score = 0;
    }

    public function render()
    {
        // Extraire les IDs des fichiers et les charger
        $fileIds = collect($this->files)->pluck('id')->toArray(); // Extraire uniquement les IDs des fichiers
        $files = Document::whereIn('id', $fileIds)->get();

        $reglements = Reglement::all();
        $demandeurs = User::all();

        return view('livewire.multi-step-form', compact('reglements', 'demandeurs', 'files'));
    }

    public function nextStep()
    {
        if ($this->step == 2 && auth()->user()->hasRole(['superadmin', 'assistance'])) {
            // Vérifier si 'demandeurId' est bien rempli
            if (empty($this->demandeurId)) {
                // Ajouter un message d'erreur si le champ est vide
                $this->addError('demandeurId', 'Vous devez sélectionner un demandeur avant de continuer.');
                return;
            }
        }
        // Vérification des réponses avant de passer à l'étape suivante
        if ($this->step == 2 && in_array('no', $this->responses)) {
            session()->flash('error', 'VOTRE DOSSIER N’EST PAS ELIGIBLE AU GUICHET DE LA BCEAO.
 BESOIN D’ASSISTANCE, prière contacter l’équipe KFM Consulting au 05 74 54 51 45 Merci
.');
            return;
        }

        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    public function updatedResponses($value, $index)
    {
        if ($value == 'yes') {
            $this->score++;
        } else {
            $this->score--;
        }
    }

    public function submit()
    {
        $rules = [
            'filePaths.*' => 'required|file|mimes:pdf,jpg,png',
        ];
        if (auth()->user()->hasRole(['superadmin', 'assistance'])) {
            $rules['demandeurId'] = 'required';
        }
        $this->validate($rules);

        $demande = Demande::create([
            'user_id' => auth()->id(),
            'reglement_id' => $this->reglementId,
            'demandeur_id' => $this->demandeurId,
        ]);

        //dd($demande);

        $demande->addHistorique('en attente', 'La demande a été créée.');
        $demande->save();

        foreach ($this->files as $file) {
            if (isset($this->uploadedFiles[$file->id])) {
                $filePath = $this->uploadedFiles[$file->id]->store('documents', 'public');
                $demande->documents()->attach($file->id, [
                    'file_path' => $filePath,
                ]);

                // Debugging
                logger()->info('File uploaded: ' . $filePath);
            }
        }

        $demandeur = User::find($this->demandeurId);
        $admins = User::role(['assistance'])->get();

        // Envoyer une notification à l'administrateur et au demandeur
        $demandeur->notify(new DemandeCreated($demande));

        $admins->each(function ($admin) use ($demande) {
            $admin->notify(new DemandeCreated($demande));
        });

        return redirect()->route('demandes.index')->with('success', 'La demande a été crée avec succès');
    }
}
