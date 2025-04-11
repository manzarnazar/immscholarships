@extends('layouts.admin')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">



            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h1 class="h3 mb-3">All Scholarships Applications</h1>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush" id="dataTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Application ID</th>
                                        <th>Student Name</th>
                                        <th>Email Address</th>
                                        <th>Status</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                @foreach ($scholarshipList as $item)
                                    <tr>
                                        <td><span class="badge bg-success"> {{ strtoupper($item->application_id) }}</span>
                                        </td>

                                        <td>
                                            @php
                                                $user = \App\Models\User::where('id', $item->student_id)->first();
                                                echo $user ? strtoupper($user->name) : 'Not Found';
                                                
                                            @endphp
                                        </td>

                                        <td>
                                            @php
                                            $user = \App\Models\User::where('id', $item->student_id)->first();
                                            echo $user ? $user->email : 'Not Found';
                                            
                                        @endphp
                                        
                                        </td>
                                        

                                        <td>

                                            @if($item->status == 'approved')

                                            <span class="badge bg-success">  {{ strtoupper($item->status) }}</span>

                                            @elseif($item->status == 'pending')

                                            <span class="badge bg-warning">  {{ strtoupper($item->status) }}</span>

                                            @elseif($item->status == 'rejected')
                                            <span class="badge bg-danger">  {{ strtoupper($item->status) }}</span>
                                            @else
                                            <span class="badge bg-danger">No Status Available</span>
                                            @endif
                                            
                                          
                                        
                                        </td>

                                        <td>{{ $item->created_at->format('F j, Y \a\t g:i A') }}</td>

                                        <td>
                                            <a href="{{ route('scholar-application-view', ['id' => $item->id]) }}" class="btn btn-primary text-white"><i class="fa fa-eye"></i> View</a>
                                           
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
