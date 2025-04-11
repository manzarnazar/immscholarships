<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    // List all staff members with optional search
    public function index(Request $request)
    {
        $query = User::where('is_staff', true);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('email', 'like', "%{$search}%");
        }

        $staff = $query->get();
        return view('admin.staff.index', compact('staff'));
    }

    // Show the form to create a new staff account
    public function create()
    {
        return view('admin.staff.create');
    }

    // Save a new staff member
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8',
            'roles'    => 'nullable|array',
        ]);

        $user = new User();
        $user->email    = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']); // secure hash
        $user->is_staff = true;
        $user->save();

        // Assign roles (if using spatie/laravel-permission, these methods are available)
        if (isset($validatedData['roles'])) {
            foreach ($validatedData['roles'] as $role) {
                $user->assignRole($role);
            }
        }

        // OPTIONAL: Dispatch an email notification here to the new staff member.
        // Mail::to($user->email)->send(new StaffCreatedNotification($user));

        return redirect()->route('staff.index')->with('success', 'Staff created successfully.');
    }

    // Show the form for editing an existing staff member
    public function edit($id)
    {
        $staff = User::findOrFail($id);
        return view('admin.staff.edit', compact('staff'));
    }

    // Update the staff member’s details and roles
    public function update(Request $request, $id)
    {
        $staff = User::findOrFail($id);

        $validatedData = $request->validate([
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
            'roles'    => 'nullable|array',
        ]);

        $staff->email = $validatedData['email'];

        if ($request->filled('password')) {
            $staff->password = Hash::make($validatedData['password']);
        }

        $staff->save();

        // Sync the roles (removes old roles and assigns new ones)
        $staff->syncRoles($validatedData['roles'] ?? []);

        // OPTIONAL: Log the activity or send a notification email for updates.

        return redirect()->route('staff.index')->with('success', 'Staff updated successfully.');
    }

    // Delete a staff member
    public function destroy($id)
    {
        $staff = User::findOrFail($id);
        $staff->delete();

        // OPTIONAL: You can log this deletion action for audit purposes.

        return redirect()->route('staff.index')->with('success', 'Staff deleted successfully.');
    }
}
