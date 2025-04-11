@extends('layouts.admin')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h1 class="h3 mb-3">All Registered Staff</h1>
                        </div>
                        <div class="col text-end">
                            <a href="{{ route('admin-users-management-create') }}" class="btn btn-success"><i
                                    class="align-middle me-2" data-feather="plus"></i>Add Staff</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush" id="dataTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Email Address</th>
                                        <th>Role</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                @foreach ($staff as $item)
                                    <tr>
                                        <td>{{ strtoupper($item->name) }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            <span class="badge bg-info">
                                            {{ strtoupper($item->user_type) }}
                                            </span>
                                        </td>
                                        <td>{{ $item->created_at->format('F j, Y \a\t g:i A') }}</td>
                                        <td><a class="btn btn-primary text-white"><i class="fa fa-eye"></i></a> <a
                                                class="btn btn-danger text-white"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
