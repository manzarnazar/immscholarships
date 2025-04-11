<!-- filepath: /home/u147348358/domains/imsscholarships.com/public_html/apply/resources/views/roles/create.blade.php -->
<!-- ...existing code... -->
<form action="{{ route('roles.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Role Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="permissions">Assign Permissions</label>
        <div>
            @foreach ($permissions as $permission)
                <div class="form-check">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="permission_{{ $permission->id }}" class="form-check-input">
                    <label for="permission_{{ $permission->id }}" class="form-check-label">
                        {{ $permission->description }} 
                        <a href="{{ $permission->link }}" target="_blank">[View]</a>
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Add Role</button>
</form>
<!-- ...existing code... -->