<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ActivityLogController extends Controller implements HasMiddleware
{

    protected $activityLogger;

    public function __construct(ActivityLogger $activityLogger)
    {
        $this->activityLogger = $activityLogger;
    }


    public static function middleware(): array
    {
        return [
            new Middleware('permission:delete logs', only: ['destroy']),
        ];
    }

    public function index()
    {
        $logs = ActivityLog::latest()->paginate(10);
        return view('activity-logs.index', [
            'logs' => $logs
        ]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $log = ActivityLog::find($id);

        if ($log == null) {
            session()->flash('error', 'Log not found');
            return response()->json([
                'status' => false
            ]);
        }
        $log->delete();

        session()->flash('success', 'Log deleted successfully');
        return response()->json([
            'status' => true
        ]);
    }
}
