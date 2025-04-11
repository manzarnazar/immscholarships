@extends('admin.layouts.master')

@section('title', 'Create Staff Account')

@section('content')
    <h1>Create Staff Account</h1>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form method="POST" action="{{ route('staff.store') }}">
        @csrf
        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter staff email" required>
        <label>Password:</label>
        <input type="password" name="password" placeholder="Enter password (min 8 characters)" required>
        <fieldset>
            <legend>Roles</legend>
            @foreach (['total_programs', 'registered_students', 'pending_applications', 'approved_applications', 'rejected_applications'] as $role)
                <label>
                    <input type="checkbox" name="roles[]" value="{{ $role }}">
                    {{ ucfirst(str_replace('_', ' ', $role)) }}
                </label>
            @endforeach
        </fieldset>
        <button type="submit">Create Staff</button>
    </form>
@endsection
