@extends('../layout/' . $layout)

@section('subhead')
    <title>Scholarship Details - IMS - Scholarship Portal</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Scholarship Details</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-12 2xl:col-span-12">
            <!-- BEGIN: Scholarship Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">{{ strtoupper($scholarships->title) }}</h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-12 gap-x-5">
                        
                        
                        
                        
                       
                       
                       
                        <div class="col-span-12">
                            <p>Date Posted: <b>{{ $scholarships->created_at->format('F j, Y \a\t g:i A') }} </b> | Teaching Language: <b>{{ strtoupper($scholarships->teaching_language) }}</b></p>
                            <small class="badge bg-info text-white">{{ $scholarships->status }}</small>
                        </div>
                        <div class="col-span-12 mt-3">
                            <img src="{{ asset($scholarships->image_path) }}" class="img-fluid" width="600px" height="325px">
                        </div>
                        <div class="col-span-12 mt-5">
                            <h4>Description</h4>
                            <p>{!! $scholarships->description !!}</p>
                        </div>
                        <div class="col-span-12 mt-5">
                            <h4>Timeline</h4>
                            <p>{!! $institution->timeline !!}</p>
                        </div>
                        <div class="col-span-12 mt-5">
                            <h4>Requirements</h4>
                            <p>{!! $institution->requirements !!}</p>
                        </div>
                        <div class="col-span-12 mt-5">
                            <h4>Application Fee</h4>
                            <p>{!! $institution->application_fee !!}</p>
                        </div>
                        <div class="col-span-12 mt-5">
                            <h4>IMS Fee</h4>
                            <p>{!! $institution->ims_fee !!}</p>
                        </div>
                        <div class="col-span-12 mt-5">
                            <h4>Scholarship</h4>
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
                          
                                <a href="{{ route('student-scholarship-store', ['id' => $scholarships->id]) }}">
                                    <!-- <button class="btn btn-danger w-20 mt-3">Apply</button> -->
                                </a>
                          
                        @endif
                    @endauth
                </div>
            </div>
            <!-- END: Scholarship Information -->
        </div>
    </div>
@endsection
