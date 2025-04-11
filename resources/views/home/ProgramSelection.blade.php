@extends('../layout/' . $layout)

@section('subhead')
    <title>Dashboard - IMS - Scholarship Portal</title>
@endsection
<style type="text/css">
    
</style>
@section('subcontent')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-12">
            <div class="grid grid-cols-12 gap-6">
                @auth
                @if(auth()->user()->user_type == 'super-admin' || auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff')
                <!-- BEGIN: General Report -->
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">General Report</h2>
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
                                    <div class="text-3xl font-medium leading-8 mt-6">$ 0.000 </div>
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
                              <a href="{{ route('admin-scholarship-index') }}">     
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
                                    <div class="text-3xl font-medium leading-8 mt-6">{{ $applicationsCountPending }}</div>
                                    <div class="text-base text-slate-500 mt-1">Pending Application</div>
                                </div>
                            </div>
                             </a>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                              <a href="{{ route('admin-scholarship-index') }}">     
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
                                    <div class="text-3xl font-medium leading-8 mt-6">{{ $applicationsCountApproved }}</div>
                                    <div class="text-base text-slate-500 mt-1">Approved Application</div>
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

                
         <!--        <div class="row flex pt-5">

                     {{-- <a href="{{ route('student-scholarship-index') }}" class="btn btn-primary"><i class="fa fa-plus"></i> MY APPLICATION</a> --}}
                     {{-- <a href="{{ route('student-scholarships') }}" class="btn btn-primary"><i class="fa fa-list"></i> ALL SCHOLARSHIPS</a> --}}

                     <a href="{{ route('student-scholarships', ['type' => 'bachelor']) }}" class="btn btn-danger"><i class="fa fa-list"></i> BACHELOR DEGREE</a>
                     &nbsp;&nbsp;
                     <a href="{{ route('student-scholarships',['type' => 'masters'] ) }}" class="btn btn-danger"><i class="fa fa-list"></i> MASTERS DEGREE</a>
                    &nbsp;&nbsp;
                     <a href="{{ route('student-scholarships', ['type' => 'language']) }}" class="btn btn-danger"><i class="fa fa-list"></i> LANGUAGE PROGRAMS</a>

                    </div>
                 </div>
 -->
              


     
               <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h1 class="text-lg font-medium truncate mr-5">Select Degree</h1>
                        <!-- <a href="" class="ml-auto flex items-center text-primary">
                            <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
                        </a> -->
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                                @if(Auth::user()->education_level == 'Bachelor')
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                             <a href="{{ route('student-scholarships', ['type' => 'bachelor']) }}" >
                            <div class="report-box zoom-in" >
                                <div class="box p-5" style="background-color: #296c5b; color: white;">
                                  
                                    <div class="text-3xl font-medium leading-8 mt-6" >BACHELOR <br> DEGREE</div>
                                    <!-- <div class="text-base text-slate-500 mt-1">Applied Scholarships</div> -->
                                </div>
                            </div>
                        </a>
                        </div>
                        @endif
                         @if(Auth::user()->education_level == 'master')
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                             <a href="{{ route('student-scholarships',['type' => 'masters'] ) }}" >
                            <div class="report-box zoom-in">
                                <div class="box p-5" style="background-color: #296c5b; color: white;">
                                
                                    <div class="text-3xl font-medium leading-8 mt-6" >MASTERS <br> DEGREE</div>
                                  
                                </div>
                            </div>
                        </a>
                        </div>
@endif

                  @if(Auth::user()->education_level == 'PHD')
                         <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                             <a href="{{ route('student-scholarships',['type' => 'PHD'] ) }}" >
                            <div class="report-box zoom-in">
                                <div class="box p-5" style="background-color: #296c5b; color: white;">
                                
                                    <div class="text-3xl font-medium leading-8 mt-6" >PHD <br> DEGREE</div>
                                  
                                </div>
                            </div>
                        </a>
                        </div>
                        @endif
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                             <a href="{{ route('student-scholarships', ['type' => 'language']) }}" >
                            <div class="report-box zoom-in">
                                 <div class="box p-5" style="background-color: #296c5b; color: white;">
                                  
                                    <div class="text-3xl font-medium leading-8 mt-6"  >LANGUAGE PROGRAMS</div>
                                  
                                </div>
                            </div>
                             </a>
                        </div>

                    </div>
                </div> 
@endif
@endauth
            </div>
        </div>

    </div>
@endsection
