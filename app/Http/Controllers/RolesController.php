<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role; // Import the Role model

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::all(); // Fetch all roles
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create'); // Ensure this view exists
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        Role::create(['name' => $request->name]);

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role')); // Ensure this view exists
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
