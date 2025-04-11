@extends('../layout/' . $layout)

@section('subhead')
    <title>Dashboard - IMS - Scholarship Portal</title>
@endsection

@section('subcontent')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-12">
            <div class="grid grid-cols-12 gap-6">
                @auth
                @if(auth()->user()->user_type == 'super-admin' || auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff')
                <!-- BEGIN: General Report -->
                
                <style>
    .report-box {
        border-radius: 1.25rem;
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        overflow: hidden;
        position: relative;
    }

    .report-box:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .report-box__icon {
        padding: 0.75rem;
        border-radius: 50%;
        color: #fff;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    .report-box__icon.text-primary {
        background: linear-gradient(135deg, #6366f1, #3b82f6);
    }

    .report-box__icon.text-success {
        background: linear-gradient(135deg, #22c55e, #10b981);
    }

    .report-box__icon.text-danger {
        background: linear-gradient(135deg, #ef4444, #dc2626);
    }

    .report-box__icon.text-warning {
        background: linear-gradient(135deg, #facc15, #f59e0b);
    }

    .report-box__icon.text-pending {
        background: linear-gradient(135deg, #fb923c, #f97316);
    }

    .text-3xl {
        color: #0f172a;
        font-weight: 700;
    }

    .text-base {
        color: #475569;
    }

    .zoom-in {
        animation: bounceIn 0.6s ease;
    }

    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: scale(0.9) translateY(20px);
        }
        60% {
            opacity: 1;
            transform: scale(1.05) translateY(-10px);
        }
        100% {
            transform: scale(1) translateY(0);
        }
    }

    .intro-y h2 {
        background: linear-gradient(to right, #8b5cf6, #4f46e5);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: bold;
    }

    a.text-primary:hover {
        color: #6366f1;
        text-decoration: underline;
    }
</style>

                
                
                
                
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">IMS Application Status</h2>
                        <a href="" class="ml-auto flex items-center text-primary">
                            <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
                        </a>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                       <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="dollar-sign" class="report-box__icon text-primary"></i>

                                        <div class="ml-auto">
                                          <!--   <div class="report-box__indicator bg-success tooltip cursor-pointer" title="33% Higher than last month">
                                                33% <i data-feather="chevron-up" class="w-4 h-4 ml-0.5"></i>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">$ {{$totalbalance ?? 0.00}} </div>
                                    <div class="text-base text-slate-500 mt-1">Total Balance</div>
                                </div>
                            </div>
                        </div> 
                                            
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                       <a href="{{ route('admin-scholarships') }}">     
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="credit-card" class="report-box__icon text-pending"></i>
                                        <div class="ml-auto">
                                           <!--  <div class="report-box__indicator bg-danger tooltip cursor-pointer" title="2% Lower than last month">
                                                2% <i data-feather="chevron-down" class="w-4 h-4 ml-0.5"></i>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{ $scholarshipsCount }}</div>
                                    <div class="text-base text-slate-500 mt-1">Total Programs</div>
                                </div>
                            </div>
                             </a>
                        </div>
                       

                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                              <a href="{{ route('admin-scholarship-status',['status' => 'pending']) }}">     
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="monitor" class="report-box__icon text-warning"></i>
                                        <div class="ml-auto">
                                           <!--  <div class="report-box__indicator bg-success tooltip cursor-pointer" title="12% Higher than last month">
                                                12% <i data-feather="chevron-up" class="w-4 h-4 ml-0.5"></i>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{ $ForadminapplicationsCountPending }}</div>
                                    <div class="text-base text-slate-500 mt-1">Pending Application</div>
                                </div>
                            </div>
                             </a>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                              <a href="{{ route('admin-scholarship-status',['status' => 'approved']) }}">     
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="user" class="report-box__icon text-success"></i>
                                        <div class="ml-auto">
                                           <!--  <div class="report-box__indicator bg-success tooltip cursor-pointer" title="22% Higher than last month">
                                                22% <i data-feather="chevron-up" class="w-4 h-4 ml-0.5"></i>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{ $ForadminapplicationsCountApproved }}</div>
                                    <div class="text-base text-slate-500 mt-1">Approved Application</div>
                                </div>
                            </div>
                             </a>
                        </div>

                         <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                              <a href="{{ route('admin-scholarship-status',['status' => 'rejected']) }}">     
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="user" class="report-box__icon text-danger"></i>
                                        <div class="ml-auto">
                                           <!--  <div class="report-box__indicator bg-success tooltip cursor-pointer" title="22% Higher than last month">
                                                22% <i data-feather="chevron-up" class="w-4 h-4 ml-0.5"></i>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{ $ForadminapplicationsCountRejected }}</div>
                                    <div class="text-base text-slate-500 mt-1">Rejected Application</div>
                                </div>
                            </div>
                             </a>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                             <a href="{{route('admin-students-list')}}">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="user" class="report-box__icon text-success"></i>
                                        <div class="ml-auto">

                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{ $studentsCount }}</div>
                                    <div class="text-base text-slate-500 mt-1">Registered Students</div>
                                </div>
                            </div>
                              </a>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <a href="{{route('admin-institutions')}}">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="user" class="report-box__icon text-success"></i>
                                        <div class="ml-auto">
                                           <!--  <div class="report-box__indicator bg-success tooltip cursor-pointer" title="22% Higher than last month">
                                                22% <i data-feather="chevron-up" class="w-4 h-4 ml-0.5"></i>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{ $institutionCount }}</div>
                                    <div class="text-base text-slate-500 mt-1">Registered Institutions</div>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END: General Report -->

<!-- Student dashboard content here -->




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

    $level = match(strtolower(Auth::user()->education_level)) {
        'bachelor' => 'Bachelor',
        'master' => 'Masters',
        'phd' => 'PhD',
        default => '',
    };

    $fee = match(strtolower(Auth::user()->education_level)) {
        'bachelor' => 450,
        'master' => 550,
        'phd' => 650,
        default => 0,
    };

    $status = $applyScholarships->status ?? '';
    $badgeClasses = [
        'approved' => 'bg-emerald-100 text-emerald-800',
        'pending' => 'bg-yellow-100 text-yellow-800',
        'rejected' => 'bg-red-100 text-red-700'
    ];
@endphp

<div class="col-span-12 mt-10">

    <!-- Fancy Header -->
    <div class="flex items-center justify-between px-6 py-4 bg-gradient-to-r from-blue-100 to-purple-100 rounded-xl shadow-sm mb-6">
        <h2 class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-700 animate-pulse">
            🎓 Welcome to Your IMS Dashboard
        </h2>
        <a href="" class="flex items-center text-blue-600 hover:text-blue-800 transition">
            <i data-feather="refresh-ccw" class="w-4 h-4 mr-2"></i> Refresh
        </a>
    </div>
    
    
    
      <!-- 🎉 Exciting News from IMS (Updated Message + Styled) -->
<div 
    x-data="{ show: true }" 
    x-show="show"
    x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0 -translate-y-4"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-4"
    class="mb-6 px-6 py-5 bg-gradient-to-br from-purple-50 via-white to-blue-50 border border-blue-100 shadow-lg rounded-xl relative hover:shadow-2xl transition-all duration-300 ease-in-out"
    x-cloak
>
    <!-- ❌ Close Button -->
    <button @click="show = false" class="absolute top-2 right-3 text-gray-400 hover:text-red-500 transition text-sm z-10">
        &times;
    </button>

    <!-- Gradient Title -->
    <h1 class="text-2xl font-extrabold bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 text-transparent bg-clip-text mb-2">
        🎉 Exciting News from IMS!
    </h1>

    <!-- Updated Message -->
    <p class="text-gray-700 mt-2 leading-relaxed text-sm">
        <span class="text-blue-700 font-semibold">Starting April 1, 2025</span>:
    </p>
    <ul class="list-disc list-inside mt-2 text-sm text-gray-700 space-y-1">
        <li><strong class="text-green-700">Free Submission</strong> – Apply at no cost.</li>
        <li><strong class="text-red-600">Application Fee</strong> – Pay a non-refundable $100 USD only if approved.</li>
        <li><strong class="text-indigo-700">Scholarship Fee</strong> – The scholarship fee should be paid only after your admission has been finalized and your scholarship confirmed.</li>
    </ul>
</div>

<!-- Visible Text in Silk Tab -->
<div class="relative mt-6">
    <div class="px-4 py-3 bg-gradient-to-r from-blue-600 via-purple-500 to-indigo-600 text-white rounded-lg shadow-md max-w-xl mx-auto">
        <p class="text-sm text-center">
            To change your education level, go to your profile picture, select "Profile," change the education level to your preferred one, and save.
        </p>
    </div>
</div>










    
    
    
    
    
    
    

    <div class="grid grid-cols-12 gap-6">

        @php
            $cardBase = 'rounded-xl p-5 bg-white border border-gray-100 shadow hover:shadow-xl transition transform hover:-translate-y-1 hover:scale-[1.02]';
            $title = 'text-sm text-gray-500 uppercase tracking-wide font-medium';
            $value = 'text-2xl font-bold text-slate-700 mt-3';
        @endphp

        <!-- Education Level -->
        <div class="col-span-12 sm:col-span-6 xl:col-span-3">
            <div class="{{ $cardBase }}">
                <div class="flex items-center">
                    <i data-feather="book" class="text-indigo-500 w-6 h-6 mr-2"></i>
                    <span class="{{ $title }}">Education Level</span>
                </div>
                <div class="{{ $value }}">{{ $level }}</div>
            </div>
        </div>

        <!-- Applied Scholarship -->
        <div class="col-span-12 sm:col-span-6 xl:col-span-3">
            @if ($applyScholarships?->scholarship_id)
            <a href="{{ route('applied-scholarship-view', ['id' => $applyScholarships->scholarship_id]) }}">
                <div class="{{ $cardBase }}">
                    <div class="flex items-center">
                        <i data-feather="award" class="text-green-500 w-6 h-6 mr-2"></i>
                        <span class="{{ $title }}">Applied Scholarship</span>
                    </div>
                    <div class="{{ $value }}">{{ $applyScholarships->scholarship->title }}</div>
                </div>
            </a>
            @else
            <div class="{{ $cardBase }}">
                <div class="flex items-center">
                    <i data-feather="slash" class="text-gray-400 w-6 h-6 mr-2"></i>
                    <span class="{{ $title }}">Applied Scholarship</span>
                </div>
                <div class="text-gray-400 text-base mt-3">No application yet</div>
            </div>
            @endif
        </div>

        <!-- Application Status -->
        <div class="col-span-12 sm:col-span-6 xl:col-span-3">
            <div class="{{ $cardBase }}">
                <div class="flex items-center">
                    <i data-feather="monitor" class="text-yellow-500 w-6 h-6 mr-2"></i>
                    <span class="{{ $title }}">Application Status</span>
                </div>
                <div class="mt-3">
                    @if ($applyScholarships?->status)
                        <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full {{ $badgeClasses[$status] ?? 'bg-gray-200 text-gray-600' }}">
                            {{ strtoupper($status) }}
                        </span>
                    @else
                        <span class="text-gray-400">No status available</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Application Fee -->
        <div class="col-span-12 sm:col-span-6 xl:col-span-3">
            <div class="{{ $cardBase }}">
                <div class="flex items-center">
                    <i data-feather="dollar-sign" class="text-emerald-500 w-6 h-6 mr-2"></i>
                    <span class="{{ $title }}">Scholarship Fee</span>
                </div>
                <div class="{{ $value }} text-emerald-600">${{ number_format($fee, 2) }}</div>
            </div>
        </div>

        <!-- Payment Status -->
        <div class="col-span-12 sm:col-span-6 xl:col-span-3">
            <a href="{{ route('student-scholarship-index') }}">
                <div class="{{ $cardBase }}">
                    <div class="flex items-center">
                        <i data-feather="credit-card" class="text-purple-500 w-6 h-6 mr-2"></i>
                        <span class="{{ $title }}">Payment Status</span>
                    </div>
                    <div class="{{ $value }} text-center">{{ strtoupper($applyScholarships->payment_status ?? 'N/A') }}</div>
                </div>
            </a>
        </div>

    </div>
</div>

                
                
                
                
                
                
                
                
                <!-- BEGIN: Minimal WhatsApp Chat Button -->
<div class="fixed bottom-24 right-6 z-[9999]">
    <a href="https://wa.me/8619502997569" target="_blank"
       class="flex items-center gap-2 bg-white/80 backdrop-blur-md border border-green-500 text-green-700 font-semibold shadow-md hover:shadow-lg px-4 py-2 rounded-full transition-all duration-300 hover:scale-105">
        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 24 24">
            <path d="M16.17 14.27c-.28-.14-1.65-.81-1.9-.9-.25-.1-.43-.14-.6.14-.18.28-.7.9-.85 1.1-.16.18-.3.2-.57.07-.28-.14-1.18-.43-2.24-1.4-.83-.74-1.4-1.65-1.57-1.92-.16-.28-.02-.43.12-.57.13-.13.28-.32.43-.48.14-.18.18-.28.28-.46.1-.14.05-.32-.02-.46-.07-.14-.6-1.44-.83-1.97-.22-.53-.44-.46-.6-.46h-.5c-.14 0-.36.05-.57.28s-.75.74-.75 1.82.77 2.11.88 2.25c.1.14 1.5 2.36 3.64 3.31 1.27.55 1.77.6 2.4.5.38-.06 1.18-.48 1.35-.95.16-.46.16-.85.1-.94-.05-.1-.27-.18-.55-.32z"/>
            <path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12c0 1.82.49 3.52 1.34 5L2 22l5.18-1.34C8.48 21.51 10.18 22 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2zm-8 10c0-4.41 3.59-8 8-8s8 3.59 8 8-3.59 8-8 8c-1.61 0-3.11-.49-4.34-1.34L4 20l1.34-4.34C4.49 15.11 4 13.61 4 12z" clip-rule="evenodd"/>
        </svg>
        <span class="text-sm">Chat with IMS</span>
    </a>
</div>
<!-- END: Minimal WhatsApp Chat Button -->





@endif
@endauth
            </div>
        </div>

  
@endsection