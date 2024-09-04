<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class DomaineController extends Controller implements HasMiddleware
{

    protected $activityLogger;

    public function __construct(ActivityLogger $activityLogger)
    {
        $this->activityLogger = $activityLogger;
    }

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view domaines', only: ['index']),
            new Middleware('permission:edit domaines', only: ['edit',]),
            new Middleware('permission:create domaines', only: ['create']),
            new Middleware('permission:delete domaines', only: ['destroy']),
        ];
    }

    public function index()
    {
        $domaines = Domaine::orderBy('created_at', 'desc')->paginate(10);

        return view('domaines.index', [
            'domaines' => $domaines,
        ]);
    }

    public function create()
    {
        return view('domaines.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:domaines|min:3',
        ]);

        $domaine = Domaine::create($request->all());

        return redirect()->route('domaines.index')
            ->with('success', 'Domaine created successfully.');
    }

    public function show(Domaine $domaine)
    {
        return view('domaines.show', compact('domaine'));
    }

    public function edit($id)
    {
        $domaine = Domaine::findOrFail($id);
        return view('domaines.edit', [
            'domaine' => $domaine,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
        ]);

        $domaine = Domaine::findOrFail($id);
        $domaine->update($request->all());

        return redirect()->route('domaines.index')
            ->with('success', 'Domaine updated successfully');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $domaine = Domaine::find($id);

        if ($domaine == null) {
            session()->flash('error', 'domaine not found');
            return response()->json([
                'status' => false,
            ]);
        }

        $domaine->delete();

        session()->flash('success', 'domaine deleted successfully');
        return response()->json([
            'status' => true,
        ]);
    }
}
