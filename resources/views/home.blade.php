@extends('layouts.admin')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Welcome , {{ Auth::user()->name }}</h1>


            @auth
                @if(auth()->user()->user_type == 'super-admin' || auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff')
                <div class="row">
                    <div class="col-xl-12 col-xxl-12 d-flex">
                        <div class="w-100">

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title">Total Categories</h5>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="box"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <h1 class="mt-1 mb-3">{{ $categoryCount }}</h1>

                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title">Total Scholarships</h5>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="users"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <h1 class="mt-1 mb-3">{{ $scholarshipsCount }}</h1>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title">Pending Application</h5>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="dollar-sign"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <h1 class="mt-1 mb-3">{{ $applicationsCountPending }}</h1>

                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title">Approved Application</h5>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="shopping-cart"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <h1 class="mt-1 mb-3">{{ $applicationsCountApproved }}</h1>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title">Registered Students</h5>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <h1 class="mt-1 mb-3">{{ $studentsCount }}</h1>

                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title">Registered Institutions</h5>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <h1 class="mt-1 mb-3">{{ $institutionCount }}</h1>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                @endif
            @endauth


            @auth
                @if(auth()->user()->user_type == 'student')

                @php
                $attachments = \App\Models\Attachments::where('user_id', auth()->user()->id)->first();
                $contactInfoHome = \App\Models\ContactInfoHome::where('user_id', auth()->user()->id)->first();
                $applicantContact = \App\Models\ContactInfoApplicant::where('user_id', auth()->user()->id)->first();
                $financial = \App\Models\FinancialSupporter::where('user_id', auth()->user()->id)->first();
                $family = \App\Models\FamilyBackground::where('user_id', auth()->user()->id)->first();
                $secondary = \App\Models\SecondaryEducation::where('user_id', auth()->user()->id)->first();
                $diploma = \App\Models\DiplomaEducation::where('user_id', auth()->user()->id)->first();
                $passportInfo = \App\Models\Passports::where('user_id', auth()->user()->id)->first();
                $basicInfo = \App\Models\Students::where('user_id', auth()->user()->id)->first();
                @endphp

                @if($attachments && $contactInfoHome && $applicantContact && $financial && $family && $secondary && $diploma && $passportInfo && $basicInfo)

                <div class="row">
                   <div class="col-md-12">
                    {{-- <a href="{{ route('student-scholarship-index') }}" class="btn btn-primary"><i class="fa fa-plus"></i> MY APPLICATION</a> --}}
                    {{-- <a href="{{ route('student-scholarships') }}" class="btn btn-primary"><i class="fa fa-list"></i> ALL SCHOLARSHIPS</a> --}}

                    <a href="{{ route('student-scholarships', ['type' => 'bachelor']) }}" class="btn btn-danger"><i class="fa fa-list"></i> BACHELOR DEGREE</a>
                    <a href="{{ route('student-scholarships',['type' => 'masters'] ) }}" class="btn btn-danger"><i class="fa fa-list"></i> MASTERS DEGREE</a>
                    <a href="{{ route('student-scholarships', ['type' => 'language']) }}" class="btn btn-danger"><i class="fa fa-list"></i> LANGUAGE PROGRAMS</a>

                   </div>
                </div>

                @endif

                <br>

                <div class="row">
                    <div class="col-xl-12 col-xxl-12 d-flex">
                        <div class="w-100">

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title">Applied Scholarships</h5>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="truck"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <h1 class="mt-1 mb-3">{{ $applicationsCountUser }}</h1>

                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title">Pending Applications</h5>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="users"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <h1 class="mt-1 mb-3">{{ $applicationsCountPendingUser }}</h1>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title">Approved Application</h5>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="dollar-sign"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <h1 class="mt-1 mb-3">{{ $applicationsCountApprovedUser }}</h1>

                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title">Rejected Application</h5>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="shopping-cart"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <h1 class="mt-1 mb-3">{{ $applicationsCountRejectedUser }}</h1>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                @endif
            @endauth



        </div>
    </main>
@endsection
