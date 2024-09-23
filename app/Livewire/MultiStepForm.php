<?php

namespace App\Livewire;

use App\Models\Demande;
use App\Models\Document;
use App\Models\Question;
use App\Models\Reglement;
use App\Models\User;
use App\Notifications\DemandeCreated;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class MultiStepForm extends Component
{
    use WithFileUploads;

    public $step = 1;
    public $score = 0;
    public $reglements = [];
    public $reglementId;
    public $questionsObligatoires = [];
    public $questionsOptionnelles = [];
    public $files = [];
    public $files1 = [];
    public $demandeurId;
    public $demandeurs = [];
    public $filePaths = [];
    public $uploadedFiles = [];
    public $responses = [];


    public function mount()
    {
        //$this->reglements = Reglement::all();
        $this->reglements = Reglement::whereHas('documents', function ($query) {
            $query->havingRaw('COUNT(*) > 1');
        })->get();
        $this->demandeurs = User::role('client')->get();

        if (auth()->user()->hasRole('client')) {
            $this->demandeurId = auth()->user()->id;
        }
    }

    public function updatedReglementId($value)
    {
        //$this->questions = Question::where('reglement_id', $value)->get();
        $this->questionsObligatoires = Question::where('reglement_id', $value)
            ->where('is_required', 1)
            ->get();

        $this->questionsOptionnelles = Question::where('reglement_id', $value)
            ->where('is_required', 0)
            ->get();

        $reglement = Reglement::with('documents')->find($value);
        $this->files = $reglement->documents;

        $this->files1 = $reglement->documentsOfQuestionsOptionnelles;

        // Initialiser dynamiquement les propriétés des fichiers obligatoires
        foreach ($this->files as $file) {
            $this->{'file' . $file->id} = null;
        }

        // Initialiser dynamiquement les propriétés des fichiers optionnels
        foreach ($this->files1 as $file) {
            $this->{'file' . $file->id} = null;
        }

        $this->responses = array_fill(0, count($this->questionsObligatoires), 'no');
    }

    public function render()
    {
        // Extraire les IDs des fichiers et les charger
        $fileIds = collect($this->files)->pluck('id')->toArray(); // Extraire uniquement les IDs des fichiers
        $files = Document::whereIn('id', $fileIds)->get();

        // Extraire les IDs des fichiers optionnels et les charger
        $fileIds1 = collect($this->files1)->pluck('id')->toArray(); // Extraire uniquement les IDs des fichiers
        $files1 = Document::whereIn('id', $fileIds1)->get();

        $reglements = Reglement::all();
        $demandeurs = User::all();

        return view('livewire.multi-step-form', compact('reglements', 'demandeurs', 'files'));
    }

    public function nextStep()
    {
        if ($this->step == 1 && auth()->user()->hasRole(['superadmin', 'assistance'])) {
            // Vérifier si 'demandeurId' est bien rempli
            if (empty($this->demandeurId)) {
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
        //dd($this->files, $this->files1);
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
                $year = date('Y');
                $month = date('m');
                $folderPath = "{$year}/{$month}/{$demande->id}";


                $filePath = $this->uploadedFiles[$file->id]->storeAs(
                    "documents/{$folderPath}",
                    $this->uploadedFiles[$file->id]->getClientOriginalName(),
                    'public'
                );

                logger()->info('File uploaded: ' . $filePath);
                $demande->documents()->attach($file->id, [
                    'file_path' => $filePath,
                ]);
            }
        }

        foreach ($this->files1 as $index => $file) {
            // Vérifier si la réponse est "yes"
            if (isset($this->responses[$index]) && $this->responses[$index] === 'yes') {
                if (isset($this->uploadedFiles[$file->id])) {
                    $year = date('Y');
                    $month = date('m');
                    $folderPath = "{$year}/{$month}/{$demande->id}";

                    $filePath1 = $this->uploadedFiles[$file->id]->storeAs(
                        "documents/{$folderPath}",
                        $this->uploadedFiles[$file->id]->getClientOriginalName(),
                        'public'
                    );

                    logger()->info('Optional file uploaded: ' . $filePath1);

                    // Enregistrer dans la table demande_documents
                    $demande->documents()->attach($file->id, [
                        'file_path' => $filePath1,
                    ]);
                }
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
