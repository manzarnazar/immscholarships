@extends('layouts.admin')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">



            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h1 class="h3 mb-3">Create New Role</h1>
                        </div>
                        <div class="col text-end">
                            <a href="{{ route('admin-roles') }}" class="btn btn-success"><i class="align-middle me-2"
                                    data-feather="arrow-back"></i>Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form id="categoryForm" method="POST" action="{{ route('admin-roles-store') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Role Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Category Name">

                                        <div class="error"></div>

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
