<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        Role::create([
            'name' => $request->name,
            'can_create' => $request->has('can_create'),
            'can_read' => $request->has('can_read'),
            'can_update' => $request->has('can_update'),
            'can_delete' => $request->has('can_delete'),
            'can_export' => $request->has('can_export'),
            'can_approve' => $request->has('can_approve'),
        ]);

        return redirect()->route('roles.index')->with('success', 'Role created successfully!');
    }

    // Edit Role
public function edit(Role $role)
{
    return view('roles.edit', compact('role'));
}

// Update Role
public function update(Request $request, Role $role)
{
    $request->validate([
        'name' => 'required|unique:roles,name,' . $role->id,
    ]);

    $role->update([
        'name' => $request->name,
        'can_create' => $request->has('can_create'),
        'can_read' => $request->has('can_read'),
        'can_update' => $request->has('can_update'),
        'can_delete' => $request->has('can_delete'),
        'can_export' => $request->has('can_export'),
        'can_approve' => $request->has('can_approve'),
    ]);

    return redirect()->route('roles.index')->with('success', 'Role updated successfully!');
}

// Delete Role
public function destroy(Role $role)
{
    $role->delete();
    return redirect()->route('roles.index')->with('success', 'Role deleted successfully!');
}



}
