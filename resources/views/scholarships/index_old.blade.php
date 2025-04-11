@extends('layouts.admin')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">



            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h1 class="h3 mb-3">All Courses Available</h1>
                        </div>
                        <div class="col text-end">
                            <a href="{{ route('admin-scholarships-create') }}" class="btn btn-success"><i
                                    class="align-middle me-2" data-feather="plus"></i>Add Course</a>
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
                                         <th>University Name</th>
                                        <th>Image Path</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                @foreach ($scholarships as $item)
                                    <tr>
                                        <td>{{ strtoupper($item->title) }}</td>
                                        <td>
                                            @php
                                                $institution = \App\Models\Institutions::find($item->institution_id);
                                                echo $institution ? strtoupper($institution->name) : 'Not Found';
                                            @endphp
                                        </td>
                                     <td>
    <!--<img src="{{ asset($item->image_path) ?: asset('images/scholarship.jpg') }}" alt="Image" width="80px" height="60px">-->
    
    @if (!empty($item->image_path) && file_exists(public_path($item->image_path)))
    <!-- Display the scholarship image -->
    <img src="{{ asset($item->image_path) }}" class="img-fluid" width="600px" height="325px">
@else
    <!-- Display a default image when the scholarship image is not loaded or not found -->
    <img src="{{ asset('images/scholarship.jpg') }}" class="img-fluid" width="600px" height="325px">
@endif
</td>

                                                <td>
                                                    <span class="badge bg-info">
                                                        {{ strtoupper($item->status) }}

                                                    </span>
                                                </td>
                                        <td>{{ $item->created_at->format('F j, Y \a\t g:i A') }}</td>
                                        {{-- @auth
                                        @if(auth()->user()->user_type == 'admin'|| auth()->user()->user_type == 'staff') --}}

                                        <td><a href="{{ route('scholarship-view', ['id' => $item->id]) }}" class="btn btn-primary text-white"><i class="fa fa-eye"></i></a> 
                                            <form action="{{ route('scholarships-delete', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            <button type="submit"
                                            class="btn btn-danger text-white"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>

                                            {{-- @endif
                                            
                                        @endauth --}}
                                      
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
