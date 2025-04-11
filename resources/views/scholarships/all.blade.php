@extends('layouts.admin')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">



            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h1 class="h3 mb-3">All  {{ strtoupper($type) }} Courses Available</h1>
                        </div>
                      
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush" id="dataTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Course Title</th>
                                        <th>Scholarship Code</th>
                                        <th>Teaching Language</th>
                                        <th>Status</th>
                                        <th>Date Posted</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                @foreach ($scholarships as $item)
                                    <tr>
                                        <td>{{ strtoupper($item->title) }}</td>
                                        <td>
                                            <span class="badge bg-success">
                                            @php
                                                $institution = \App\Models\Institutions::find($item->institution_id);
                                                echo $institution ? strtoupper($institution->code) : 'Not Found';
                                            @endphp
                                            </span>
                                        </td>
                                        <td>{{ strtoupper($item->teaching_language) }}</td>

                                        <td>
                                            <span class="badge bg-info">
                                                {{ strtoupper($item->status) }}

                                            </span>
                                        </td>
                                        <td>{{ $item->created_at->format('F j, Y \a\t g:i A') }}</td>

                                        <td><a href="{{ route('scholarship-view', ['id' => $item->id]) }}"
                                                class="btn btn-primary text-white"><i class="fa fa-eye"></i> View</a>

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
