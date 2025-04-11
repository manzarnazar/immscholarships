@extends('layouts.admin')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Scholarship Details</h1>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ strtoupper($scholarships->title) }} </h5>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-12">
                                    <p>Date Posted: <b>{{ $scholarships->created_at->format('F j, Y \a\t g:i A') }} </b> | Teaching Language: <b> {{ strtoupper($scholarships->teaching_language) }}</b></p>
                                    <small class="badge bg-info text-white">{{ $scholarships->status }}</small>

                                </div>

                            </div>

                            <br>

                            <hr>


                            <div class="row">

                                <div class="col-md-12">
                                
                                    <img src="{{ asset($scholarships->image_path) }}" class="img-fluid" width="600px" height="325px">

                                </div>



                                <div class="col-md-12">
                                    <p class="h4">Description</p>

                                    <p>{!! $scholarships->description !!}</p>

                                </div>

                                <div class="col-md-12">
                                    <p class="h4">Timeline</p>
                                    <p>{!! $institution->timeline !!}</p>
                                </div>

                                <div class="col-md-12">
                                    <p class="h4">Requirements</p>
                                    <p>{!! $institution->requirements !!}</p>
                                </div>

                                <div class="col-md-12">
                                    <p class="h4">Application Fee</p>
                                    <p>{!! $institution->application_fee !!}</p>
                                </div>

                                <div class="col-md-12">
                                    <p class="h4">IMS Fee</p>
                                    <p>{!! $institution->ims_fee !!}</p>
                                </div>

                                <div class="col-md-12">
                                    <p class="h4">Scholarship</p>
                                    <p>{!! $institution->scholarship !!}</p>
                                </div>

                            </div>

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

                            @auth
                                @if (auth()->user()->user_type == 'student')

                                @if($attachments && $contactInfoHome && $applicantContact && $financial && $family && $secondary && $diploma && $passportInfo && $basicInfo)

                                    <a href="{{ route('student-scholarship-store', ['id' => $scholarships->id]) }}"><button
                                            class="btn btn-danger">Apply</button></a>
                                @endif
                                @endif
                            @endauth


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
