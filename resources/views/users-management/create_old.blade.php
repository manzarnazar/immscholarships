@extends('layouts.admin')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">



            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h1 class="h3 mb-3">Register New User</h1>
                        </div>
                        <div class="col text-end">
                            <a href="{{ route('admin-users-management') }}" class="btn btn-success"><i class="align-middle me-2"
                                    data-feather="arrow-back"></i>Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form id="categoryForm" method="POST" action="{{ route('admin-users-management-store') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Name">

                                        <div class="error"></div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Email Address">
                                        <div class="error"></div>
                                    </div>
                                </div>

                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Password">

                                        <div class="error"></div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Role</label>
                                        <?php
                                        use App\Models\Roles;
                                        $categories = Roles::pluck('name', 'id');
                                        ?>
        
                                        <select name="user_type" id="user_type" class="form-control show-tick ms select2"
                                            data-placeholder="Select">
                                            <option value="">Select Role</option>
                                            <?php foreach ($categories as $id => $name): ?>
                                            <option value="<?= $name ?>"><?= strtoupper($name) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

        
                            </div>

                            <br>

                          




                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
