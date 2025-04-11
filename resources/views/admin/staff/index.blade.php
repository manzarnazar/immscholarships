@extends('admin.layouts.master')

@section('title', 'Staff Management')

@section('content')
    <h1>Staff Management</h1>
    <form method="GET" action="{{ route('staff.index') }}">
        <input type="text" name="email" placeholder="Search by email" value="{{ request('email') }}">
        <button type="submit">Search</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($staff as $member)
                <tr>
                    <td>{{ $member->id }}</td>
                    <td>{{ $member->email }}</td>
                    <td>
                        @foreach ($member->getRoleNames() as $role)
                            <span class="badge">{{ $role }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('staff.edit', $member->id) }}">Edit</a>
                        <form method="POST" action="{{ route('staff.destroy', $member->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No staff found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $staff->links() }}
@endsection
