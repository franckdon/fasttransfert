<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ContactController extends Controller implements HasMiddleware
{
    protected $activityLogger;

    public function __construct(ActivityLogger $activityLogger)
    {
        $this->activityLogger = $activityLogger;
    }

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view messages', only: ['index']),
            new Middleware('permission:delete messages', only: ['destroy'])
        ];
    }

    public function index()
    {
        $messages = Message::orderBy('created_at', 'desc')->paginate(25);
        return view('messages.index', [
            'messages' => $messages,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->passes()) {
            $message = Message::create($request->all());

            return redirect()->route('contact')
                ->with('success', 'message sent successfully.');
        }

        return response()->json(['error' => $validator->errors()->all()], 422);
    }

    public function show($id)
    {
        $message = Message::find($id);

        if ($message == null) {
            session()->flash('error', 'message not found');
            return redirect()->route('messages.index');
        }

        $message->is_read = true;
        $message->save();

        return view('messages.show', [
            'message' => $message,
        ]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $message = Message::find($id);

        if ($message == null) {
            session()->flash('error', 'message not found');
            return response()->json([
                'status' => false
            ]);
        }
        $message->delete();

        session()->flash('success', 'message deleted successfully');
        return response()->json([
            'status' => true
        ]);
    }
}
