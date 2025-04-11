@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Staff Management</h1>
    <a href="{{ route('staff.create') }}" class="btn btn-primary">Add Staff</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($staff as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name ?? 'N/A' }}</td>
                <td>{{ $user->status ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('staff.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('staff.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
