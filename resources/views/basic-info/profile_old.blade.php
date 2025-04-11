@extends('layouts.admin')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Student Profile | Home</h1>

            </div>
            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Profile Details</h5>
                        </div>
                        <div class="card-body text-center">

                            @foreach ($student as $profile)
                            <img src="{{  asset($profile->image_path) ?? asset('default.jpg') }}" alt="Christina Mason"
                            class="img-fluid rounded-circle mb-2" width="128" height="128" />
                            @endforeach

                          


                            <h5 class="card-title mb-0">{{ Auth::user()->name }}</h5>


                            <div>
                                <a class="btn btn-primary btn-sm"
                                    href="#">{{ strtoupper(Auth::user()->user_type) }}</a>

                            </div>
                        </div>
                        <hr class="my-0" />
                        <div class="card-body">
                            <h5 class="h6 card-title">Contact Details</h5>
                            <p>Email Address: <strong>{{ Auth::user()->email }}</strong> </p>
                           


                        </div>
                        <hr class="my-0" />

                    </div>
                </div>

                <div class="col-md-8 col-xl-9">
                    <div class="card">
                        <div class="card-header">

                            <h5 class="card-title mb-0 text-primary">Student  Basic Informations</h5>

                            <hr>

                        </div>
                        <div class="card-body h-100">

                            @forelse ($student as $item)
                                
                          
                            <div class="row">
                                
                                    <div class="col-md-4">
                                        <p>Fisrt Name: <strong>{{ $item->first_name }}</strong> </p>
                                    </div>

                                    <div class="col-md-4">
                                        <p>Middle Name: <strong>{{ $item->middle_name }}</strong> </p>
                                    </div>

                                    <div class="col-md-4">
                                        <p>Last Name: <strong>{{ $item->last_name }}</strong> </p>
                                    </div>

                               
                            </div>

                            <div class="row">
                                
                                <div class="col-md-4">
                                    <p>Date of Birth: <strong>{{ $item->dob }}</strong> </p>
                                </div>

                                <div class="col-md-4">
                                    <p>Birth Place: <strong>{{ $item->place_of_birth }}</strong> </p>
                                </div>

                                <div class="col-md-4">
                                    <p>Gender: <strong>{{ $item->gender }}</strong> </p>
                                </div>

                           
                        </div>

                            @empty

                            <div class="row">
                                <div class="col-md-12">
                                    <p class="h4 text-danger"><i class="align-middle me-2"
                                        data-feather="info"></i> No Information available</p>
                                </div>
                            </div>
                                
                            @endforelse

                            <br>

                            <h5 class="card-title mb-0 text-primary">Education  Background Informations</h5>

                            <hr>

                            <br>

                            <p class="text text-success">BACHELOR DEGREE EDUCATION BACKGROUND</p>
                            <hr>

                            @forelse ($degreeEducation as $item)
                                
                          
                            <div class="row">
                                
                                    <div class="col-md-4">
                                        <p>Start Date: <strong>{{ $item->start_date }}</strong> </p>
                                    </div>

                                    <div class="col-md-4">
                                        <p>End Date: <strong>{{ $item->end_date }}</strong> </p>
                                    </div>

                                    <div class="col-md-4">
                                        <p>Institution Name: <strong>{{ $item->institution_name }}</strong> </p>
                                    </div>

                               
                            </div>

                            <div class="row">
                                
                                <div class="col-md-4">
                                    <p>Course Studied: <strong>{{ $item->major_subject }}</strong> </p>
                                </div>

                                <div class="col-md-4">
                                    <p>Award: <strong>{{ $item->award }}</strong> </p>
                                </div>

                              

                           
                        </div>

                            @empty

                            <div class="row">
                                <div class="col-md-12">
                                    <p class="h4 text-danger"><i class="align-middle me-2"
                                        data-feather="info"></i> No Information available</p>
                                </div>
                            </div>
                                
                            @endforelse

                            <p class="text text-success">HIGHSCHOOL/DIPLOMA EDUCATION BACKGROUND</p>
                            <hr>

                            @forelse ($diplomaEducation as $item)
                                
                          
                            <div class="row">
                                
                                    <div class="col-md-4">
                                        <p>Start Date: <strong>{{ $item->start_date }}</strong> </p>
                                    </div>

                                    <div class="col-md-4">
                                        <p>End Date: <strong>{{ $item->end_date }}</strong> </p>
                                    </div>

                                    <div class="col-md-4">
                                        <p>Institution Name: <strong>{{ $item->institution_name }}</strong> </p>
                                    </div>

                               
                            </div>

                            <div class="row">
                                
                                <div class="col-md-4">
                                    <p>Course Studied: <strong>{{ $item->major_subject }}</strong> </p>
                                </div>

                                <div class="col-md-4">
                                    <p>Award: <strong>{{ $item->award }}</strong> </p>
                                </div>

                              

                           
                        </div>

                            @empty

                            <div class="row">
                                <div class="col-md-12">
                                    <p class="h4 text-danger"><i class="align-middle me-2"
                                        data-feather="info"></i> No Information available</p>
                                </div>
                            </div>
                                
                            @endforelse


                            <br>

                            <p class="text text-success">SECONDARY EDUCATION BACKGROUND</p>
                            <hr>

                            @forelse ($secondaryEducation as $item)
                                
                          
                            <div class="row">
                                
                                    <div class="col-md-4">
                                        <p>Start Date: <strong>{{ $item->start_date }}</strong> </p>
                                    </div>

                                    <div class="col-md-4">
                                        <p>End Date: <strong>{{ $item->end_date }}</strong> </p>
                                    </div>

                                    <div class="col-md-4">
                                        <p>Institution Name: <strong>{{ $item->institution_name }}</strong> </p>
                                    </div>

                               
                            </div>

                            <div class="row">
                                
                                <div class="col-md-4">
                                    <p>Course Studied: <strong>{{ $item->major_subject }}</strong> </p>
                                </div>

                                <div class="col-md-4">
                                    <p>Award: <strong>{{ $item->award }}</strong> </p>
                                </div>

                              

                           
                        </div>

                            @empty

                            <div class="row">
                                <div class="col-md-12">
                                    <p class="h4 text-danger"><i class="align-middle me-2"
                                        data-feather="info"></i> No Information available</p>
                                </div>
                            </div>
                                
                            @endforelse

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
