<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Demande;

class DemandeTable extends DataTableComponent
{
    protected $model = Demande::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function query()
    {
        return Demande::query()
            ->leftJoin('historiques', function ($join) {
                $join->on('demandes.id', '=', 'historiques.demande_id')
                    ->whereIn('historiques.id', function ($query) {
                        $query->selectRaw('MAX(id)')
                            ->from('historiques')
                            ->groupBy('demande_id');
                    });
            })
            ->select(
                'demandes.id',
                'demandeur.name as demandeur_name',
                'user.name as user_name',
                'historiques.status as last_status',
                'historiques.commentaire as last_commentaire',
                'demandes.created_at'
            )
            ->leftJoin('users as demandeur', 'demandes.demandeur_id', '=', 'demandeur.id')
            ->leftJoin('users as user', 'demandes.user_id', '=', 'user.id')
            ->with(['demandeur', 'user']);
    }



    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Demandeur", "demandeur.name")
                ->sortable(),
            Column::make("Utilisateur", "user.name")
                ->sortable(),
            Column::make("Status", "") // Utilise la colonne calculée last_status
                ->sortable()
                ->searchable(),
            // Column::make("Commentaire", "") // Utilise la colonne calculée last_commentaire
            //     ->sortable()
            //     ->searchable(),
            Column::make("Créé le", "created_at")
                ->sortable(),

            Column::make('Actions')
                ->label(
                    function ($row, Column $column) {
                        $editButton = view('components.buttons.show-button', ['route' => route('demandes.show', $row->id)])->render();
                        $deleteButton = view('components.buttons.delete-button', ['id' => $row->id, 'functionName' => 'deleteDemande'])->render();
                        return $editButton . $deleteButton;
                    }
                )->html(),
        ];
    }

    public function delete($id)
    {
        Demande::find($id)->delete();
        session()->flash('message', 'Demande supprimée avec succès.');
        $this->emit('refreshTable');
    }
}
