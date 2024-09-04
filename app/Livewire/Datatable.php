<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Model;

class Datatable extends Component
{
    use WithPagination;

    public $model;
    public $search = '';
    public $sortField = 'id';
    public $sortAsc = true;
    public $searchableColumns = []; // Colonnes dynamiques de recherche

    public function mount($model, $searchableColumns = null)
    {
        $this->model = $model;
        $this->searchableColumns = $searchableColumns ?? ['name']; // Définir des colonnes par défaut
    }

    // Réinitialiser la pagination à chaque changement de recherche
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function render()
    {
        // Ajouter un débogage pour voir la valeur actuelle de la recherche
        if ($this->search) {
            dd($this->search);
        }

        // Commence une nouvelle requête avec le modèle dynamique
        $query = $this->model::query();

        // Appliquer la recherche sur les colonnes spécifiées
        if (!empty($this->search)) {
            $query->where(function ($query) {
                foreach ($this->searchableColumns as $column) {
                    $query->orWhere($column, 'like', '%' . $this->search . '%');
                }
            });
        }

        // Appliquer le tri par colonne
        $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');

        // Obtenir les données paginées
        $data = $query->paginate(10);

        return view('livewire.datatable', ['data' => $data]);
    }
}
