<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Demande;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole(['superadmin', 'assistance'])) {
            $demandes = Demande::count();

            $demandesPending = Demande::whereHas('historiques', function ($query) {
                $query->where('status', 'en attente')
                    ->whereRaw('historiques.id = (select max(h2.id) from historiques h2 where h2.demande_id = historiques.demande_id)');
            })->count();

            $demandesApproved = Demande::whereHas('historiques', function ($query) {
                $query->where('status', 'approuvée')
                    ->whereRaw('historiques.id = (select max(h2.id) from historiques h2 where h2.demande_id = historiques.demande_id)');
            })->count();

            $demandesRejected = Demande::whereHas('historiques', function ($query) {
                $query->where('status', 'rejetée')
                    ->whereRaw('historiques.id = (select max(h2.id) from historiques h2 where h2.demande_id = historiques.demande_id)');
            })->count();
        }

        if (auth()->user()->hasRole('client')) {
            $demandes = Demande::where('user_id', auth()->id())->count();

            $demandesPending = Demande::where('user_id', auth()->id())->whereHas('historiques', function ($query) {
                $query->where('status', 'en attente')
                    ->whereRaw('historiques.id = (select max(h2.id) from historiques h2 where h2.demande_id = historiques.demande_id)');
            })->count();

            $demandesApproved = Demande::where('user_id', auth()->id())->whereHas('historiques', function ($query) {
                $query->where('status', 'approuvée')
                    ->whereRaw('historiques.id = (select max(h2.id) from historiques h2 where h2.demande_id = historiques.demande_id)');
            })->count();

            $demandesRejected = Demande::where('user_id', auth()->id())->whereHas('historiques', function ($query) {
                $query->where('status', 'rejetée')
                    ->whereRaw('historiques.id = (select max(h2.id) from historiques h2 where h2.demande_id = historiques.demande_id)');
            })->count();
        }

        $demandesRecentes = Demande::orderBy('created_at', 'desc')->paginate(10);
        $logs = ActivityLog::orderBy('created_at', 'desc')->paginate(10);

        return view(
            'dashboard',
            ([
                'demandes' => $demandes,
                'demandesPending' => $demandesPending,
                'demandesApproved' => $demandesApproved,
                'demandesRejected' => $demandesRejected,
                'demandesRecentes' => $demandesRecentes,
                'logs' => $logs
            ])
        );
    }
}
