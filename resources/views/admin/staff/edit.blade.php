@extends('admin.layouts.master')

@section('title', 'Edit Staff Account')

@section('content')
    <h1>Edit Staff Account</h1>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form method="POST" action="{{ route('staff.update', $staff->id) }}">
        @csrf
        @method('PUT')
        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email', $staff->email) }}" placeholder="Enter staff email" required>
        <label>Password (leave blank to keep current):</label>
        <input type="password" name="password" placeholder="Enter new password (optional)">
        <fieldset>
            <legend>Roles</legend>
            @foreach (['total_programs', 'registered_students', 'pending_applications', 'approved_applications', 'rejected_applications'] as $role)
                <label>
                    <input type="checkbox" name="roles[]" value="{{ $role }}" 
                        {{ $staff->getRoleNames()->contains($role) ? 'checked' : '' }}>
                    {{ ucfirst(str_replace('_', ' ', $role)) }}
                </label>
            @endforeach
        </fieldset>
        <button type="submit">Update Staff</button>
    </form>
@endsection
