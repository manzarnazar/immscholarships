@extends('../layout/' . $layout)

@section('subhead')
    <title>Incredible Scholarship Details - IMS Scholarship Portal</title>
@endsection

@section('subcontent')

@if ($errors->any())
    <div class="alert alert-danger">
        {!! $errors->first('message') !!}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <div class="intro-y flex items-center mt-8">
        <h2 class="text-3xl font-extrabold text-green-900 mr-auto">Program Name</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-12 2xl:col-span-12">
            <!-- BEGIN: Scholarship Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-extrabold text-2xl text-green-900 mr-auto">{{ strtoupper($scholarships->title) }}</h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-12 gap-x-5">
                        <div class="col-span-12">
                            <?php 
                                $institution = \App\Models\Institutions::where('id', $scholarships->institution_id)->first(); 
                                $country = \App\Models\Countries::where('id', $institution->country)->first();
                            ?>
                                          
                            <p>Date Posted: <b>{{ $scholarships->created_at->format('F j, Y \a\t g:i A') }}</b> | Teaching Language: <b>{{ strtoupper($scholarships->teaching_language) }}</b> | Country: <b>{{$country->name}}</b> | City: <b>{{ strtoupper($institution->city) }}</b></p>
                            <small class="badge bg-info text-white">{{ $scholarships->status }}</small>
                        </div>
                        <div class="col-span-12 mt-3">
                            <img src="{{ asset($scholarships->image_path) }}" class="img-fluid" width="600px" height="325px">
                        </div>
                        <div class="col-span-12 mt-5">
                            <h4 class="text-2xl font-bold text-green-900">Program Description</h4>
                            <p>{!! $scholarships->description !!}</p>
                        </div>
                        <div class="col-span-12 mt-5">
                            <h4 class="text-2xl font-bold text-green-900">Important Dates & Timeline</h4>
                            <p>{!! $institution->timeline !!}</p>
                        </div>
                        <div class="col-span-12 mt-5">
                            <h4 class="text-2xl font-bold text-green-900">Requirements</h4>
                            <p>{!! $institution->requirements !!}</p>
                        </div>
                        <div class="col-span-12 mt-5">
                            <h4 class="text-2xl font-bold text-green-900">University Fee Details</h4>
                            <p>{!! $institution->application_fee !!}</p>
                        </div>
                        <div class="col-span-12 mt-5">
                            <h4 class="text-2xl font-bold text-green-900">IMS Processing Fee</h4>
                            <p>{!! $institution->ims_fee !!}</p>
                        </div>
                        <div class="col-span-12 mt-5">
                            <h4 class="text-2xl font-bold text-green-900">Exclusive Scholarship Benefits</h4>
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
                                <button class="btn btn-danger w-20 mt-3">Submit</button>
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
            <!-- END: Scholarship Information -->
        </div>
    </div>
@endsection
