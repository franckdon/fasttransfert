<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Question;
use App\Models\Reglement;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view questions', only: ['index']),
            new Middleware('permission:edit questions', only: ['edit',]),
            new Middleware('permission:create questions', only: ['create']),
            new Middleware('permission:delete questions', only: ['destroy']),
        ];
    }
    public function index($id)
    {
        $reglement = Reglement::findOrFail($id);
        return view('questions.index', [
            'reglement' => $reglement,
            'questions' => $reglement->questions()->paginate(10),
        ]);
    }

    public function create($id)
    {
        $reglement = Reglement::findOrFail($id);
        $documents = Document::all();
        return view('questions.create', [
            'reglement' => $reglement,
            'documents' => $documents,
        ]);
    }

    public function store(Request $request, $id)
    {
        $reglement = Reglement::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'intitule' => 'required',
            'question_type' => 'required',

        ]);
        if ($validator->passes()) {
            $is_required = $request->question_type == 'required' ? 1 : 0;
            $is_complementary = $request->question_type == 'complementary' ? 1 : 0;
            $document_id = $is_complementary ? $request->document_id : null;

            if ($is_complementary && !$document_id) {
                dd('here');
                return redirect()->route('questions.create', $reglement->id)->withErrors('document is required')->withInput();
            }

            if ($is_complementary && $document_id) {
                $documentExist = $reglement->questions()->where('document_id', $document_id)->exists();
                //dd($documentExist);
                if ($documentExist) {
                    return redirect()->route('questions.create', $reglement->id)->withErrors('document already exist')->withInput();
                }
            }

            $question = Question::create([
                'intitule' => $request->intitule,
                'reglement_id' => $reglement->id,
                'is_required' => $is_required,
                'is_complementary' => $is_complementary,
                'document_id' => $document_id,
            ]);

            return redirect()->route('questions.index', $reglement->id)->with('success', 'Question created successfully');
        } else {
            return redirect()->route('questions.create', $reglement->id)->withErrors($validator)->withInput();
        }
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        $documents = Document::all();
        return view('questions.edit', [
            'question' => $question,
            'documents' => $documents,
        ]);
    }

    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'intitule' => 'required',
            'question_type' => 'required',

        ]);

        if ($validator->passes()) {
            $is_required = $request->question_type == 'required' ? 1 : 0;
            $is_complementary = $request->question_type == 'complementary' ? 1 : 0;
            $document_id = $is_complementary ? $request->document_id : null;

            if ($is_complementary && !$document_id) {
                return redirect()->route('questions.edit', $question->id)->withErrors('document is required')->withInput();
            }

            if ($is_complementary && $document_id) {
                $documentExist = $question->reglement->questions()->where('document_id', $document_id)->exists();
                if ($documentExist) {
                    return redirect()->route('questions.edit', $question->id)->withErrors('document already exist')->withInput();
                }
            }

            $question->update([
                'intitule' => $request->intitule,
                'is_required' => $is_required,
                'is_complementary' => $is_complementary,
                'document_id' => $document_id,
            ]);

            return redirect()->route('questions.index', $question->reglement_id)->with('success', 'Question updated successfully');
        } else {
            return redirect()->route('questions.edit', $question->id)->withErrors($validator)->withInput();
        }

        // $question = Question::findOrFail($id);
        // $validator = Validator::make($request->all(), [
        //     'intitule' => 'required',
        // ]);

        // if ($validator->passes()) {
        //     $question->update([
        //         'intitule' => $request->intitule,
        //     ]);

        //     return redirect()->route('questions.index', $question->reglement_id)->with('success', 'Question updated successfully');
        // } else {
        //     return redirect()->route('questions.edit', $question->id)->withErrors($validator)->withInput();
        // }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $question = Question::find($id);

        if ($question == null) {
            session()->flash('error', 'question not found');
            return response()->json([
                'status' => false
            ]);
        }
        $question->delete();

        session()->flash('success', 'question deleted successfully');
        return response()->json([
            'status' => true
        ]);
    }
}
