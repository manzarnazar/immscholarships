@extends('../layout/' . $layout)

@section('subhead')
    <title>University Details - IMS - Scholarship Portal</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">University Details</h2>
    </div>
<style type="text/css">
    .custom-list-style ol {
    list-style-type: auto !important;
    padding: 5px !important;
}

</style>
    <!-- University Information Section -->
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="intro-y box p-5 mt-6">
                <div class="flex items-center justify-between border-b border-slate-200/60 dark:border-darkmode-400 pb-4 mb-6">
                    <h2 class="font-medium text-lg">{{ strtoupper($institution->name) }}</h2>
                </div>

                <div class="grid grid-cols-12 gap-6">
                    <!-- Basic Info -->
                    <div class="col-span-12 lg:col-span-6">
                        <div class="flex items-center space-x-2">
                            <i data-feather="map-pin" class="text-primary"></i>
                            <h4 class="font-medium text-lg">Location</h4>
                        </div>
                        <div class="mt-3">
                            <p><strong>Country:</strong> 
                                {{ $institution && $institution->country ? \App\Models\Countries::getNameById($institution->country) : 'Not Available' }}
                            </p>
                            <p><strong>Province:</strong> 
                                {{ $institution && $institution->province ? $institution->province : 'Not Available' }}
                            </p>
                            <p><strong>City:</strong> 
                                {{ $institution && $institution->city ? $institution->city : 'Not Available' }}
                            </p>
                        </div>
                    </div>

                    <!-- Study Details -->
                    <div class="col-span-12 lg:col-span-6">
                        <div class="flex items-center space-x-2">
                            <i data-feather="book" class="text-primary"></i>
                            <h4 class="font-medium text-lg">Study Details</h4>
                        </div>
                        <div class="mt-3">
                            <p><strong>Education Level:</strong> {{ $institution->education_level }}</p>
                            <p><strong>Duration:</strong> {{ $institution->duration }}</p>
                        </div>
                    </div>

                    <!-- Fees & IMS Fees -->
                    <div class="col-span-12 lg:col-span-6">
                        <div class="flex items-center space-x-2">
                            <i data-feather="dollar-sign" class="text-primary"></i>
                            <h4 class="font-medium text-lg">Fees</h4>
                        </div>
                        <div class="mt-3 custom-list-style">
                            <p> 
                                <!-- <strong>Application Fee:</strong>  -->
                                {!! $institution->application_fee !!}</p>
                           <i data-feather="calendar" class="text-primary"></i> <p> <strong> IMS Application Fee:</strong> {!! $institution->ims_fee !!}</p>
                        </div>
                    </div>

                    <!-- Institution Code -->
                    <div class="col-span-12 lg:col-span-6">
                        <div class="flex items-center space-x-2">
                            <i data-feather="code" class="text-primary"></i>
                            <h4 class="font-medium text-lg">Institution Code</h4>
                        </div>
                        <div class="mt-3">
                            <p><strong>Code:</strong> <span>{!! $institution->code !!}</span></p>
                        </div>
                    </div>

                    <!-- Application Timeline -->
                    <div class="col-span-12">
                        <div class="flex items-center space-x-2">
                            <i data-feather="calendar" class="text-primary"></i>
                            <h4 class="font-medium text-lg">Application Timeline</h4>
                        </div>
                        <div class="mt-3">
                            <p>{!! $institution->timeline !!}</p>
                        </div>
                    </div>

                    <!-- Admission Requirements -->
                    <div class="col-span-12">
                        <div class="flex items-center space-x-2">
                            <i data-feather="clipboard" class="text-primary"></i>
                            <h4 class="font-medium text-lg">Admission Requirements</h4>
                        </div>
                        <div class="mt-3">
                            <p>{!! $institution->requirements !!}</p>
                        </div>
                    </div>

                    <!-- Scholarship -->
                    <div class="col-span-12">
                        <div class="flex items-center space-x-2">
                            <i data-feather="award" class="text-primary"></i>
                            <h4 class="font-medium text-lg">Scholarship Opportunities</h4>
                        </div>
                        <div class="mt-3">
                            <p>{!! $institution->scholarship !!}</p>
                        </div>
                    </div>
                </div>

                <!-- Apply Button -->
                @auth
                    @if (auth()->user()->user_type == 'student')
                        <a href="{{ route('student-scholarship-store', ['id' => $institution->id]) }}">
                            <button class="btn btn-danger w-20 mt-5">Apply</button>
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
@endsection
