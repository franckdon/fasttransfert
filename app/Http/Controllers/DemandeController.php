<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Demande;
use App\Models\Reglement;
use App\Models\User;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class DemandeController extends Controller implements HasMiddleware
{
    protected $activityLogger;

    public function __construct(ActivityLogger $activityLogger)
    {
        $this->activityLogger = $activityLogger;
    }

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view demandes', only: ['index']),
            new Middleware('permission:edit demandes', only: ['edit',]),
            new Middleware('permission:create demandes', only: ['create']),
            new Middleware('permission:delete demandes', only: ['destroy']),
        ];
    }

    public function index()
    {
        if (auth()->user()->hasRole(['superadmin', 'assistance'])) {
            $demandes = Demande::latest()->paginate(10);
        }
        if (auth()->user()->hasRole('client')) {
            $demandes = Demande::where('user_id', auth()->id())->latest()->paginate(10);
        }
        return view('demandes.index', compact('demandes'));
    }

    public function create()
    {
        $usersWithUserRole = User::role('client')->get();
        $reglements = Reglement::all();
        return view('demandes.create', ([
            'users' => $usersWithUserRole,
            'reglements' => $reglements
        ]));
    }

    public function show($id)
    {
        $demande = Demande::findOrFail($id);
        return view('demandes.show', ([
            'demande' => $demande
        ]));
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $demande = Demande::find($id);

        if ($demande == null) {
            session()->flash('error', 'Demande not found');
            return response()->json([
                'status' => false
            ]);
        }
        $demande->delete();

        session()->flash('success', 'demande deleted successfully');
        return response()->json([
            'status' => true
        ]);
    }
}
