<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ '/dashboard/home' }}" style="text-decoration: none">
            <span class="align-middle">IMS - Dashboard</span>
        </a>

        <ul class="sidebar-nav">

            <!----Admin Module--->
            <li class="sidebar-header">
                APPLICATION MANAGEMENT
            </li>

            @auth
                @if (auth()->user()->user_type == 'staff' ||
                        auth()->user()->user_type == 'super-admin' ||
                        auth()->user()->user_type == 'admin')
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="{{ '/dashboard/home' }}">
                            <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        SCHOLARSHIP MODULE
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin-scholarship-index') }}">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Scholarships
                                Applications</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        INSTITUTION MODULE
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin-institutions-create') }}">
                            <i class="align-middle" data-feather="plus"></i> <span class="align-middle">Create Institution
                            </span>
                        </a>
                    </li>


                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin-institutions') }}">
                            <i class="align-middle" data-feather="box"></i> <span class="align-middle">Institutions List
                            </span>
                        </a>
                    </li>



                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin-scholarships-create') }}">
                            <i class="align-middle" data-feather="plus"></i> <span class="align-middle">Add
                                Course</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin-scholarships') }}">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">All
                                Courses</span>
                        </a>
                    </li>
                @endif
            @endauth


            @auth
                @if (auth()->user()->user_type == 'super-admin' || auth()->user()->user_type == 'admin')
                    <li class="sidebar-header">
                        USERS MANAGEMENT
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin-students-list') }}">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Registered
                                Students</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin-users-management') }}">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Staff
                                Management</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin-roles') }}">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Roles &amp;
                                Permissions</span>
                        </a>
                    </li>

                    <!--- End Admin Module--->
                @endif
            @endauth


            @auth
                @if (auth()->user()->user_type == 'student')
                    <li class="sidebar-header">
                        Basic Informations
                    </li>

                    <li class="sidebar-item {{ Request::is('dashboard/home') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ url('/dashboard/home') }}">
                            <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Dashboard</span>
                        </a>
                    </li>


                    @php
                        $basicInfo = \App\Models\Students::where('user_id', auth()->user()->id)->first();
                    @endphp

                    @if (!$basicInfo)
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('basic-info') }}">
                                <i class="align-middle" data-feather="x" style="color: red"></i> <span
                                    class="align-middle">Personal
                                    Informations</span>
                            </a>
                        </li>
                    @else
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('basic-info') }}">
                                <i class="align-middle" data-feather="check-square" style="color: rgb(23, 215, 23);"></i>
                                <span class="align-middle">Personal
                                    Informations</span>
                            </a>
                        </li>
                    @endif






                    @php
                        $passportInfo = \App\Models\Passports::where('user_id', auth()->user()->id)->first();
                    @endphp

                    @if (!$passportInfo)
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('passport-info') }}">
                                <i class="align-middle" data-feather="x" style="color: red"></i> <span
                                    class="align-middle">Passport
                                    Infromations</span>
                            </a>
                        </li>
                    @else
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('passport-info') }}">
                                <i class="align-middle" data-feather="check-square" style="color: rgb(23, 215, 23);"></i>
                                <span class="align-middle">Passport
                                    Infromations</span>
                            </a>
                        </li>
                    @endif





                    <li class="sidebar-header">
                        Language Infromations
                    </li>


                    @php
                    $englishAbility = \App\Models\EnglishAbility::where('user_id', auth()->user()->id)->first();
                    @endphp

                    @if(!$englishAbility)
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('english-ability') }}">
                            <i class="align-middle" data-feather="x" style="color: red"></i> <span class="align-middle">English
                                Ability</span>
                        </a>
                    </li>

                    @else

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('english-ability') }}">
                            <i class="align-middle" data-feather="check-square" style="color: rgb(23, 215, 23);"></i> <span class="align-middle">English
                                Ability</span>
                        </a>
                    </li>

                    @endif

                    @php
                    $chineseAbility = \App\Models\ChineseAbility::where('user_id', auth()->user()->id)->first();
                    @endphp

                    @if(!$chineseAbility)
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('chinese-ability') }}">
                            <i class="align-middle" data-feather="x" style="color: red"></i> <span class="align-middle">Chinese
                                Ability</span>
                        </a>
                    </li>

                    @else


                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('chinese-ability') }}">
                            <i class="align-middle" data-feather="check-square" style="color: rgb(23, 215, 23);"></i> <span class="align-middle">Chinese
                                Ability</span>
                        </a>
                    </li>

                    @endif


                    <li class="sidebar-header">
                        Education Informations
                    </li>



                    @php
                    $degree = \App\Models\DegreeEducation::where('user_id', auth()->user()->id)->first();
                    @endphp

                    @if(!$degree)
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('degree-education') }}">
                            <i class="align-middle" data-feather="x" style="color: red"></i> <span class="align-middle">Bachelor
                                Degree
                                Education</span>
                        </a>
                    </li>

                    @else

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('degree-education') }}">
                            <i class="align-middle" data-feather="check-square" style="color: rgb(23, 215, 23);"></i> <span class="align-middle">Bachelor
                                Degree
                                Education</span>
                        </a>
                    </li>


                    @endif


                    @php
                    $diploma = \App\Models\DiplomaEducation::where('user_id', auth()->user()->id)->first();
                    @endphp

                    @if(!$diploma)

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('diploma-education') }}">
                            <i class="align-middle" data-feather="x" style="color: red"></i> <span
                                class="align-middle">Highschool/Diploma Education</span>
                        </a>
                    </li>

                    @else

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('diploma-education') }}">
                            <i class="align-middle" data-feather="check-square" style="color: rgb(23, 215, 23);"></i> <span
                                class="align-middle">Highschool/Diploma Education</span>
                        </a>
                    </li>

                    @endif


                    @php
                    $secondary = \App\Models\SecondaryEducation::where('user_id', auth()->user()->id)->first();
                    @endphp

                    @if(!$secondary)
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('secondary-education') }}">
                            <i class="align-middle" data-feather="x" style="color: red"></i> <span class="align-middle">Secondary
                                Education</span>
                        </a>
                    </li>

                    @else

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('secondary-education') }}">
                            <i class="align-middle" data-feather="check-square" style="color: rgb(23, 215, 23);"></i> <span class="align-middle">Secondary
                                Education</span>
                        </a>
                    </li>

                    @endif



                    @php
                    $family = \App\Models\FamilyBackground::where('user_id', auth()->user()->id)->first();
                    @endphp

                    @if(!$family)
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('family-background') }}">
                            <i class="align-middle" data-feather="x" style="color: red"></i> <span class="align-middle">Family
                                Backgrounds</span>
                        </a>
                    </li>

                    @else

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('family-background') }}">
                            <i class="align-middle" data-feather="check-square" style="color: rgb(23, 215, 23);"></i> <span class="align-middle">Family
                                Backgrounds</span>
                        </a>
                    </li>


                    @endif



                    @php
                    $financial = \App\Models\FinancialSupporter::where('user_id', auth()->user()->id)->first();
                    @endphp

                    @if(!$financial)
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('financial-supporter') }}">
                            <i class="align-middle" data-feather="x" style="color: red"></i> <span class="align-middle">Financial
                                Supporter</span>
                        </a>
                    </li>

                    @else

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('financial-supporter') }}">
                            <i class="align-middle" data-feather="check-square" style="color: rgb(23, 215, 23);"></i> <span class="align-middle">Financial
                                Supporter</span>
                        </a>
                    </li>


                    @endif


                    @php
                    $applicantContact = \App\Models\ContactInfoApplicant::where('user_id', auth()->user()->id)->first();
                    @endphp


                    @if(!$applicantContact)
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('contact-info-applicant') }}">
                            <i class="align-middle" data-feather="x" style="color: red"></i> <span class="align-middle">Contact
                                Info(Applicant)</span>
                        </a>
                    </li>

                    @else

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('contact-info-applicant') }}">
                            <i class="align-middle" data-feather="check-square" style="color: rgb(23, 215, 23);"></i> <span class="align-middle">Contact
                                Info(Applicant)</span>
                        </a>
                    </li>

                    @endif


                    @php
                    $contactInfoHome = \App\Models\ContactInfoHome::where('user_id', auth()->user()->id)->first();
                    @endphp


                    @if(!$contactInfoHome)

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('contact-info-home') }}">
                            <i class="align-middle" data-feather="x" style="color: red"></i> <span class="align-middle">Contact
                                Info(Home
                                Country)</span>
                        </a>
                    </li>

                    @else

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('contact-info-home') }}">
                            <i class="align-middle" data-feather="check-square" style="color: rgb(23, 215, 23);"></i> <span class="align-middle">Contact
                                Info(Home
                                Country)</span>
                        </a>
                    </li>


                    @endif


                    @php
                    $attachments = \App\Models\Attachments::where('user_id', auth()->user()->id)->first();
                    @endphp

                    @if(!$attachments)

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('attachments-index') }}">
                            <i class="align-middle" data-feather="x" style="color: red"></i> <span
                                class="align-middle">Attachments</span>
                        </a>
                    </li>

                    @else

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('attachments-index') }}">
                            <i class="align-middle" data-feather="check-square" style="color: rgb(23, 215, 23);"></i> <span
                                class="align-middle">Attachments</span>
                        </a>
                    </li>


                    @endif
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('student-scholarship-index') }}">
                            <i class="align-middle" data-feather="printer"></i> <span class="align-middle">My
                                Applications</span>
                        </a>
                    </li>
                @endif
            @endauth

        </ul>


    </div>
</nav>
