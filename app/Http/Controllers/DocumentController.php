<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view permissions', only: ['index']),
            new Middleware('permission:edit permissions', only: ['edit',]),
            new Middleware('permission:create permissions', only: ['create']),
            new Middleware('permission:delete permissions', only: ['destroy']),
        ];
    }

    public function index()
    {
        $documents = Document::orderBy('name', 'ASC')->paginate(10);
        return view('documents.index', [
            'documents' => $documents,
        ]);
    }

    public function create()
    {
        return view('documents.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->passes()) {
            $document = Document::create([
                'name' => $request->name,
            ]);

            return redirect()->route('documents.index')->with('success', 'document created successfully');
        } else {
            return redirect()->route('documents.create')->withErrors($validator)->withInput();
        }
    }

    public function edit($id)
    {
        $document = Document::findOrFail($id);
        return view('documents.edit', [
            'document' => $document,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->passes()) {
            $document = Document::findOrFail($id);
            $document->update([
                'name' => $request->name,
            ]);

            return redirect()->route('documents.index')->with('success', 'document updated successfully');
        } else {
            return redirect()->route('documents.edit', $id)->withErrors($validator)->withInput();
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $document = Document::find($id);

        if ($document == null) {
            session()->flash('error', 'Document not found');
            return response()->json([
                'status' => false
            ]);
        }
        $document->delete();

        session()->flash('success', 'Document deleted successfully');
        return response()->json([
            'status' => true
        ]);
    }
}
