<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::with('roles')->get();
        return view('admin.permissions.index', compact('permissions')); // Changed to view
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.permissions.create', compact('roles')); // Add this
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:permissions|max:255',
        ]);

        Permission::create($validated);

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission created!');
    }

    public function show(Permission $permission)
    {
        return view('admin.permissions.show', compact('permission')); // Changed to view
    }

    public function edit(Permission $permission)
    {
        $roles = Role::all();
        return view('admin.permissions.edit', compact('permission', 'roles')); // Add this
    }

    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => 'required|unique:permissions,name,'.$permission->id.'|max:255',
        ]);

        $permission->update($validated);

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission updated!');
    }

    public function destroy(Permission $permission)
    {
        if ($permission->roles()->exists()) {
            return redirect()->back()
                ->with('error', 'Cannot delete: Permission is assigned to roles!'); // Web error
        }

        $permission->delete();
        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission deleted!'); // Web success
    }

    public function assignRoles(Permission $permission, Request $request)
    {
        $request->validate([
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $permission->roles()->sync($request->roles);

        return redirect()->route('admin.permissions.edit', $permission)
            ->with('success', 'Roles assigned successfully!'); // Web response
    }
}