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

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Demandeur id", "demandeur.name")
                ->sortable(),
            Column::make("User id", "user.name")
                ->sortable(),
            Column::make("Statut", "lastHistory.status")
                ->sortable()
                ->searchable(),
            Column::make("Comentaire", "lastHistory.commentaire")
                ->sortable()
                ->searchable(),
            Column::make("Created at", "created_at")
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
