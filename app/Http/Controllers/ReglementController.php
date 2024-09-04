<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Reglement;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;

class ReglementController extends Controller implements HasMiddleware
{
    protected $activityLogger;

    public function __construct(ActivityLogger $activityLogger)
    {
        $this->activityLogger = $activityLogger;
    }

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view reglements', only: ['index']),
            new Middleware('permission:edit reglements', only: ['edit',]),
            new Middleware('permission:create reglements', only: ['create']),
            new Middleware('permission:delete reglements', only: ['destroy']),
        ];
    }

    public function index()
    {
        $reglements = Reglement::latest()->paginate(10);
        return view(
            'reglements.index',
            ['reglements' => $reglements]
        );
    }

    public function create()
    {
        return view('reglements.create');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->passes()) {
            $reglement = Reglement::create([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return redirect()->route('reglements.index')->with('success', 'Reglement created successfully');
        } else {
            return redirect()->route('reglements.create')->withErrors($validator)->withInput();
        }
    }

    public function show($id)
    {
        $reglement = Reglement::find($id);
        return view('reglements.show', compact('reglement'));
    }

    public function edit($id)
    {
        $reglement = Reglement::find($id);
        return view('reglements.edit', compact('reglement'));
    }

    public function update(Request $request, $id)
    {
        $reglement = Reglement::find($id);

        if ($reglement == null) {
            session()->flash('error', 'reglement not found');
            return redirect()->route('reglements.index');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->passes()) {
            $reglement->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return redirect()->route('reglements.index')->with('success', 'Reglement updated successfully');
        } else {
            return redirect()->route('reglements.edit', $id)->withErrors($validator)->withInput();
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $reglement = Reglement::find($id);

        if ($reglement == null) {
            session()->flash('error', 'reglement not found');
            return response()->json([
                'status' => false
            ]);
        }
        $reglement->delete();

        session()->flash('success', 'Reglement deleted successfully');
        return response()->json([
            'status' => true
        ]);
    }

    public function questions(Reglement $reglement)
    {
        return view('reglements.questions', compact('reglement'));
    }

    public function documents($id)
    {
        $reglement = Reglement::find($id);
        $documents = $reglement->documents;
        $allDocuments = Document::all();
        return view('reglements.documents', ([
            'reglement' => $reglement,
            'documents' => $documents,
            'allDocuments' => $allDocuments
        ]));
    }

    public function attachDocuments(Request $request, $id)
    {
        $reglement = Reglement::find($id);
        $validator = Validator::make($request->all(), [
            'reglement_id' => 'required',
            'document_id' => 'required',
            'is_required' => 'required|nullable',
        ]);

        // Convertir la valeur en 1 ou 0
        $isRequired = $request->has('is_required') ? 1 : 0;
        if ($validator->passes()) {
            $reglement->documents()->attach($request->document_id, ['is_required' => $isRequired]);
            return redirect()->route('reglements.documents', $id)->with('success', 'Document attached successfully');
        } else {
            return redirect()->route('reglements.documents', $id)->withErrors($validator)->withInput();
        }
    }

    public function detachDocuments(Request $request, $id)
    {
        $reglement = Reglement::find($id);
        $validator = Validator::make($request->all(), [
            'reglement_id' => 'required',
            'document_id' => 'required',
        ]);

        if ($validator->passes()) {
            $reglement->documents()->detach($request->document_id);
            return redirect()->route('reglements.documents', $id)->with('success', 'Document detached successfully');
        } else {
            return redirect()->route('reglements.documents', $id)->withErrors($validator)->withInput();
        }
    }
}
