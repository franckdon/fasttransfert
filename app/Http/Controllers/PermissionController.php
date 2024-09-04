<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PermissionController extends Controller implements HasMiddleware
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
        $permissions = Permission::orderBy('created_at', 'desc')->paginate(10);

        return view('permissions.index', [
            'permissions' => $permissions,
        ]);
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions|min:3',
        ]);

        $permission = Permission::create($request->all());

        return redirect()->route('permissions.index')
            ->with('success', 'Permission created successfully.');
    }

    public function show(Permission $permission)
    {
        return view('permissions.show', compact('permission'));
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.edit', [
            'permission' => $permission,
        ]);
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:permissions,name,' . $id . ',id',
        ]);

        if ($validator->passes()) {
            $permission->name = $request->name;
            $permission->save();

            return redirect()->route('permissions.index')
                ->with('success', 'Permission updated successfully.');
        } else {
            return redirect()->route('permissions.create')
                ->withErrors($validator)
                ->withInput();
        }

        return redirect()->route('permissions.index')
            ->with('success', 'Permission created successfully.');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $permission = Permission::find($id);

        if ($permission == null) {
            session()->flash('error', 'Permission not found');
            return response()->json([
                'status' => false,
            ]);
        }

        $permission->delete();

        session()->flash('success', 'Permission deleted successfully');
        return response()->json([
            'status' => true,
        ]);
    }

    public function assignRole(Request $request, Permission $permission)
    {
        $request->validate([
            'role_id' => 'required',
        ]);

        $permission->assignRole($request->role_id);

        return redirect()->route('permissions.index')
            ->with('success', 'Role assigned successfully');
    }

    public function removeRole(Request $request, Permission $permission)
    {
        $request->validate([
            'role_id' => 'required',
        ]);

        $permission->removeRole($request->role_id);

        return redirect()->route('permissions.index')
            ->with('success', 'Role removed successfully');
    }
}
