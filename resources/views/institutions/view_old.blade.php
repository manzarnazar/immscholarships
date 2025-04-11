@extends('layouts.admin')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h1 class="h3 mb-3">All Registered Institutions</h1>
                        </div>
                        <div class="col text-end">
                            <a href="{{ route('admin-institutions-create') }}" class="btn btn-success"><i class="align-middle me-2"
                                    data-feather="plus"></i>Add New</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush" id="dataTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>University Name</th>
                                        <th>Code</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Province</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @foreach ($institutions as $item)
                                    <tr>
                                        <td>{{ strtoupper($item->name) }}</td>
                                        <td>
                                            <span class="badge bg-primary">
                                            {{ $item->code }}
                                            </span>
                                        </td>
                                        <td>{{ strtoupper($item->country) }}</td>
                                        <td>{{ strtoupper($item->city) }}</td>
                                        <td>{{ strtoupper($item->province) }}</td>
                                        <td>{{ $item->created_at->format('F j, Y \a\t g:i A') }}</td>
                                        <td>
                                            <a href="{{ route('admin-institutions-view', ['id' => $item->id]) }}" class="btn btn-primary text-white"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('admin-institutions-edit', $item->id) }}" class="btn btn-success text-white"><i class="fa fa-edit"></i></a>
                                            <form action="{{ route('institutions-delete', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            <button
                                                type="submit" class="btn btn-danger text-white"><i class="fa fa-trash"></i></button>
                                            </form>
                                            </td>
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
