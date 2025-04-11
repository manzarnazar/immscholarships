@extends('admin.layouts.master')

@section('title', 'Roles & Permissions')

@section('content')
    <h1>Roles & Permissions</h1>
    <a href="{{ route('roles.create') }}">Create New Role</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a href="{{ route('roles.edit', $role->id) }}">Edit</a>
                        <form method="POST" action="{{ route('roles.destroy', $role->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No roles found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
