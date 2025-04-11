@extends('../layout/' . $layout)

@section('subhead')
    <title>IMS - Scholarship Portal</title>
@endsection

@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">Review Applicant Informations</h2>

    <div class="intro-y box col-span-12">
        <div class="p-5">
            <div class="grid grid-cols-12 gap-4">
                <!-- Personal Information Section -->
                <div class="col-span-8 md:col-span-8 lg:col-span-8">
                    <h3 class="text-lg font-medium">Personal Information | Applicant</h3>
                    <br>
                    <div class="flex"> <!-- Increased the gap to 6 -->
                        @foreach ($student as $item)
                            <img src="{{ asset($item->image_path) ?? asset('default.jpg') }}"
                                 alt="Applicant Image"
                                 class="rounded-full border mr-3 border-gray-300"
                                 style="object-fit: cover; width: 80px; height: 80px;">
                        @endforeach
                    </div>
                </div>
                <!-- Action Buttons -->
                <div class="col-span-4 ">
                    @foreach ($scholarApplication as $item)
                        @if ($item->status == 'pending')
                            <a href="{{ route('scholarship-approve', ['id' => $item->id]) }}" class="btn btn-success">
                                <i class="fa fa-check"></i> Approve
                            </a>
                          <!--   <a href="{{ route('scholarship-reject', ['id' => $item->id]) }}" class="btn btn-danger">
                                <i class="fa fa-close"></i> Reject
                            </a> -->

                        @endif
                    @endforeach
                    <a onclick="window.print()" class="btn btn-info">
                        <i class="fa fa-print"></i> Print Application
                    </a>


             @if ($item->status == 'pending')     
<div id="reasonForm-{{ $item->id }} " style="margin-top: 10px;">
    <form action="{{ route('scholarship-reject', ['id' => $item->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="reason"> <h3 class="text-lg font-medium">Reason for Rejection:</h3></label>
            <textarea class="form-control" name="reason" id="reason-{{ $item->id }}" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-danger mt-2">Reject</button>
      
    </form>
</div>
 @endif
                </div>
            </div>
        </div>
    </div>


    <div class="intro-y box col-span-12 mt-3">
        <div class="p-5">
            @forelse ($scholarApplication as $item)
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12">
                        <p>
                            Application ID: <span class="bg-green-500 text-white px-2 py-1 rounded-md">{{ $item->application_id }}</span> |
                            Date Applied: <strong>{{ $item->created_at->format('F j, Y \a\t g:i A') }}</strong> |
                            Highest Education Level: <strong>{{ strtoupper($student->first()->highest_education) }}</strong> |
                            Application Status: <strong>{{ strtoupper($item->status) }}</strong>
                        </p>
                    </div>
                </div>
                <hr class="my-3">
            @empty
                <p class="text-danger">No Data Available!</p>
            @endforelse
              <h3 class="text-lg font-medium">Personal Information</h3>
            <hr>
            <!-- Personal Information Section -->
            @forelse ($student as $data)
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-3">
                        <p>First Name: <strong>{{ strtoupper($data->first_name) }}</strong></p>
                    </div>
                     <div class="col-span-3">
                        <p>Last Name: <strong>{{ strtoupper($data->last_name) }}</strong></p>
                    </div>
                     <div class="col-span-3">
                        <p>Middle Name: <strong>{{ strtoupper($data->middle_name) ?? '' }}</strong></p>
                    </div>
                    <div class="col-span-3">
                        <p>Sex: <strong>{{ strtoupper($data->gender) }}</strong></p>
                    </div>
                    <div class="col-span-3">
                        <p>Date of Birth: <strong>{{ $data->dob }}</strong></p>
                    </div>
                    <div class="col-span-3">
                        <p>Place of Birth: <strong>
                            @php
                                $country = \App\Models\Countries::find($data->country_of_birth);
                                echo $country ? $country->name : 'Not Found';
                            @endphp
                        </strong></p>
                    </div>
                     <div class="col-span-3">
                        <p>Profession: <strong>{{ $data->profession ?? ''}}</strong></p>
                    </div>
                     <div class="col-span-3">
                        <p>Hobby: <strong>{{ $data->hobby }}</strong></p>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-4 mt-4">
                    <div class="col-span-3">
                        <p>Marital Status: <strong>{{ strtoupper($data->marital_status) }}</strong></p>
                    </div>
                      <div class="col-span-3">
                        <p>Native language: <strong>{{ strtoupper($data->native_language ?? '') }}</strong></p>
                    </div>
                    <div class="col-span-3">
                        <p>Mobile Number: <strong>{{ $data->mobile }}</strong> </p>
                    </div>
                    <div class="col-span-3">
                        <p>Country of Origin: <strong>
                            @php
                                $country = \App\Models\Countries::find($data->country_origin);
                                echo $country ? $country->name : 'Not Found';
                            @endphp
                        </strong></p>
                    </div>
                     <div class="col-span-3">
                        <p>Current Address: <strong>{{ $data->current_address }}</strong> </p>
                    </div>
                     <div class="col-span-3">
                        <p>Current City: <strong>{{ $data->current_city }}</strong> </p>
                    </div>
                     <div class="col-span-3">
                        <p>Available: <strong>{{ $data->available_in_china }}</strong> </p>
                    </div>
                     <div class="col-span-3">
                        <p>Chinese Name: <strong>{{ $data->chinese_name }}</strong> </p>
                    </div>
                     <div class="col-span-3">
                        <p>Health Status: <strong>{{ $data->health_status }}</strong> </p>
                    </div>
                    <div class="col-span-3">
                        <p>Highest Education: <strong>{{ strtoupper($data->highest_education) }}</strong></p>
                    </div>
                </div>
            @empty
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12">
                        <p class="h4 text-danger"><i class="align-middle me-2" data-feather="info"></i> No Information available</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>


    <div class="intro-y box mt-3 col-span-12">
        <div class="p-5">
            <h3 class="text-lg font-medium">Passport Information</h3>
            <hr>
            @forelse ($passport as $pass)
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-3">
                        <p>Passport Number: <strong>{{ $pass->passport_number }}</strong></p>
                    </div>
                    <div class="col-span-3">
                        <p>Passport Issue Date: <strong>{{ $pass->issued_date }}</strong></p>
                    </div>
                    <div class="col-span-3">
                        <p>Passport Expiry Date: <strong>{{ $pass->expiry_date }}</strong></p>
                    </div>
                    <div class="col-span-3">
                        <p>Last Name: <strong>{{ $pass->last_name }}</strong></p>
                    </div>
                    <div class="col-span-3">
                        <p>First Name: <strong>{{ $pass->first_name }}</strong></p>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-4 mt-4">
                    <div class="col-span-6">
                        <p class="text ">Certificate Attachment</p>
                        <a href="{{ asset($pass->image_path) ?? asset('default.jpg') }}" download class="btn btn-success">
                            <i class="fa fa-download"></i> Download
                        </a>
                    </div>
                </div>
                <hr class="my-3">
            @empty
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12">
                        <p class="h4 text-danger"><i class="align-middle me-2" data-feather="info"></i> No Information available</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>





<!-- BEGIN: Family Information -->
        <div class="intro-y box col-span-12 p-5 mt-5">
            <div class="p-5">
                <h3 class="text-lg font-medium">Family information</h3>
                <hr>
                <div class="mt-3">
                    @forelse ($FamilyBackground as $FamilyBackgrounds)
                        <div class="grid grid-cols-12 gap-4 mt-2">
                            <div class="col-span-3">
                                <p><strong>Relationship:</strong> {{ $FamilyBackgrounds->relationship ?? 'None'}}</p>
                            </div>
                            <div class="col-span-3">
                                <p><strong>Name:</strong> {{ $FamilyBackgrounds->name ?? 'None'}}</p>
                            </div>
                            <div class="col-span-3">
                                <p><strong>Profession:</strong> {{ $FamilyBackgrounds->profession ?? 'None'}}</p>
                            </div>
                            <div class="col-span-3">
                                <p><strong>Work Institution:</strong> {{ $FamilyBackgrounds->work_institution ?? 'None'}}</p>
                            </div>
                             <div class="col-span-3">
                                <p><strong>Country:</strong> {{ $FamilyBackgrounds->country ?? 'None'}}</p>
                            </div>
                             <div class="col-span-3">
                                <p><strong>Mobile:</strong> {{ $FamilyBackgrounds->mobile ?? 'None'}}</p>
                            </div>
                           
                        </div>
                        <hr class="my-3">
                    @empty
                        <p class="text-danger">No Family Information available.</p>
                    @endforelse
                </div>
            </div>
        </div>
 <!-- END: end Family Information -->


   <!-- BEGIN: Applicant Contact Information (Applicant) -->
        <div class="intro-y box col-span-12 mt-5">
            <div class="p-5">
                <h3 class="text-lg font-medium">Contact Information (Applicant)</h3>
                @forelse ($applicantContact as $contact)
                    <div class="grid grid-cols-12 gap-4 mt-2">
                        <div class="col-span-3">
                            <p><strong>Mobile:</strong> {{ $contact->phone }}</p>
                        </div>
                        <div class="col-span-3">
                            <p><strong>Email:</strong> {{ $contact->email }}</p>
                        </div>
                        <div class="col-span-3">
                            <p><strong>Current Address:</strong> {{ $contact->physical_address }}</p>
                        </div>
                        <div class="col-span-3">
                            <p><strong>Postal Code:</strong> {{ $contact->postcode }}</p>
                        </div>
                    </div>
                    <hr class="my-3">
                @empty
                    <p class="text-danger">No Contact Information available.</p>
                @endforelse
            </div>
        </div>
        <!-- END: Applicant Contact Information (Applicant) -->


         <!-- BEGIN: English Education Information -->
        <div class="intro-y box col-span-12 pt-5 mt-5">
            <div class="p-5">
                <h3 class="text-lg font-medium">English Proficiency Information</h3>
                <hr>
                <div class="mt-3">
                    @forelse ($EnglishAbility as $EnglishAbilitys)
                        <div class="grid grid-cols-12 gap-4 mt-2">
                            <div class="col-span-3">
                                <p><strong>English level:</strong> {{ $EnglishAbilitys->english_level ?? 'None'}}</p>
                            </div>
                            <div class="col-span-3">
                                <p><strong>Toefl:</strong> {{ $EnglishAbilitys->toefl ?? 'None'}}</p>
                            </div>
                            <div class="col-span-3">
                                <p><strong>Ielts:</strong> {{ $EnglishAbilitys->ielts ?? 'None'}}</p>
                            </div>
                            <div class="col-span-3">
                                <p><strong>Gre:</strong> {{ $EnglishAbilitys->gre ?? 'None'}}</p>
                            </div>
                            <div class="col-span-3">
                                <p><strong>Gmat:</strong> {{ $EnglishAbilitys->gmat ?? 'None'}}</p>
                            </div>
                           
                            <div class="col-span-6">
                                <p><strong>Other:</strong>
                               {{ $EnglishAbilitys->other ?? 'None' }}</p>
                            </div>
                        </div>
                        <hr class="my-3">
                    @empty
                        <p class="text-danger">No English Education Information available.</p>
                    @endforelse
                </div>
            </div>
        </div>
 <!-- END: end Education Information -->


   <!-- BEGIN: chinesee Education Information -->
        <div class="intro-y box col-span-12 pt-5 mt-5">
            <div class="p-5">
                <h3 class="text-lg font-medium">Chinese Proficiency Information</h3>
                <hr>
                <div class="mt-3">
                    @forelse ($ChineseAbility as $ChineseAbilitys)
                        <div class="grid grid-cols-12 gap-4 mt-2">
                            <div class="col-span-3">
                                <p><strong>Chinese level:</strong> {{ $ChineseAbilitys->chinese_level ?? 'None'}}</p>
                            </div>
                            <div class="col-span-3">
                                <p><strong>HSKK Score:</strong> {{ $ChineseAbilitys->hsk_score ?? 'None'}}</p>
                            </div>
                            <div class="col-span-3">
                                <p><strong>HSKK Grade:</strong> {{ $ChineseAbilitys->hskk_grade ?? 'None'}}</p>
                            </div>
                            <div class="col-span-3">
                                <p><strong>HSSK Score:</strong> {{ $ChineseAbilitys->hssk_score ?? 'None'}}</p>
                            </div>
                           
                        </div>
                        <hr class="my-3">
                    @empty
                        <p class="text-danger">No chinese Education Information available.</p>
                    @endforelse
                </div>
            </div>
        </div>
 <!-- END: end chinesee Information -->

    <div class="intro-y box mt-3 col-span-12 ">
        <div class="p-5">
            <h3 class="text-lg font-medium">Secondary Education Information</h3>
            <hr>
            @forelse ($secondaryEducation as $secondary)
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-3">
                        <p>Institution/School Name: <strong>{{ $secondary->institution_name }}</strong></p>
                    </div>
                    <div class="col-span-3">
                        <p>Start Date: <strong>{{ $secondary->start_date }}</strong></p>
                    </div>
                    <div class="col-span-3">
                        <p>End Date: <strong>{{ $secondary->end_date }}</strong></p>
                    </div>
                    <div class="col-span-3">
                        <p>Award: <strong>{{ $secondary->award }}</strong></p>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-4 mt-4">
                    <div class="col-span-3">
                        <p>Major Subject: <strong>{{ $secondary->major_subject }}</strong></p>
                    </div>
                    <div class="col-span-3">
                        <p>Country Studied: <strong>
                            @php
                                $country = \App\Models\Countries::find($secondary->country);
                                echo $country ? $country->name : 'Not Found';
                            @endphp
                        </strong></p>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-4 mt-4">
                    <div class="col-span-6">
                        <p class="text ">Certificate Attachment</p>
                         <a href="{{ asset($secondary->image_path) }}" target="_blank" class="btn btn-danger">
    <i class="fa fa-eye"></i> View
</a>
                        <a href="{{ asset($secondary->image_path) ?? asset('default.jpg') }}" download class="btn btn-success">
                            <i class="fa fa-download"></i> Download
                        </a>
                    </div>
                </div>
                <hr class="my-3">
            @empty
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12">
                        <p class="h4 text-danger"><i class="align-middle me-2" data-feather="info"></i> No Information available</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <div class="intro-y box mt-3 col-span-12">
        <div class="p-5">
            <h3 class="text-lg font-medium">Highschool/Diploma Education Information</h3>
            <hr>
            @forelse ($diplomaEducation as $diploma)
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-3">
                        <p>Institution/School Name: <strong>{{ $diploma->institution_name }}</strong></p>
                    </div>
                    <div class="col-span-3">
                        <p>Start Date: <strong>{{ $diploma->start_date }}</strong></p>
                    </div>
                    <div class="col-span-3">
                        <p>End Date: <strong>{{ $diploma->end_date }}</strong></p>
                    </div>
                    <div class="col-span-3">
                        <p>Award: <strong>{{ $diploma->award }}</strong></p>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-4 mt-4">
                    <div class="col-span-3">
                        <p>Major Subject: <strong>{{ $diploma->major_subject }}</strong></p>
                    </div>
                    <div class="col-span-3">
                        <p>Country Studied: <strong>
                            @php
                                $country = \App\Models\Countries::find($diploma->country);
                                echo $country ? $country->name : 'Not Found';
                            @endphp
                        </strong></p>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-4 mt-4">
                    <div class="col-span-6">
                        <p class="text ">Certificate Attachment</p>
                         <a href="{{ asset($diploma->image_path) }}" target="_blank" class="btn btn-danger">
    <i class="fa fa-eye"></i> View
</a>
                        <a href="{{ asset($diploma->image_path) ?? asset('default.jpg') }}" download class="btn btn-success">
                            <i class="fa fa-download"></i> Download
                        </a>

                    </div>
                </div>
                <hr class="my-3">
            @empty
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12">
                        <p class="h4 text-danger"><i class="align-middle me-2" data-feather="info"></i> No Information available</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>



    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Degree Education Information -->
        <div class="intro-y box col-span-12">
            <div class="p-5">
                <h3 class="text-lg font-medium">Degree Education Information</h3>
                <div class="mt-3">
                    @forelse ($degreeEducation as $degree)
                        <div class="grid grid-cols-12 gap-4 mt-2">
                            <div class="col-span-3">
                                <p><strong>Institution:</strong> {{ $degree->institution_name }}</p>
                            </div>
                            <div class="col-span-3">
                                <p><strong>Start Date:</strong> {{ $degree->start_date }}</p>
                            </div>
                            <div class="col-span-3">
                                <p><strong>End Date:</strong> {{ $degree->end_date }}</p>
                            </div>
                            <div class="col-span-3">
                                <p><strong>Award:</strong> {{ $degree->award }}</p>
                            </div>
                            <div class="col-span-3">
                                <p><strong>Major Subject:</strong> {{ $degree->major_subject }}</p>
                            </div>
                            <div class="col-span-3">
                                <p>
                                    <strong>Country Studied:</strong>
                                    {{ optional(\App\Models\Countries::find($degree->country))->name ?? 'Not Found' }}
                                </p>
                            </div>
                            <div class="col-span-6">
                                <p><strong>Certificate Attachment:</strong></p>
                                 <a href="{{ asset($degree->image_path) }}" target="_blank" class="btn btn-danger">
    <i class="fa fa-eye"></i> View
</a>
                                <a href="{{ asset($degree->image_path) }}" download class="btn btn-success">Download</a>
                            </div>
                        </div>
                        <hr class="my-3">
                    @empty
                        <p class="text-danger">No Degree Education Information available.</p>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- END: Degree Education Information -->



             <!-- BEGIN: Master Education Information -->
        <div class="intro-y box col-span-12">
            <div class="p-5">
                <h3 class="text-lg font-medium">Master Education Information</h3>
                <div class="mt-3">
                    @forelse ($MasterEducation as $degree)
                        <div class="grid grid-cols-12 gap-4 mt-2">
                            <div class="col-span-3">
                                <p><strong>Institution:</strong> {{ $degree->institution_name }}</p>
                            </div>
                            <div class="col-span-3">
                                <p><strong>Start Date:</strong> {{ $degree->start_date }}</p>
                            </div>
                            <div class="col-span-3">
                                <p><strong>End Date:</strong> {{ $degree->end_date }}</p>
                            </div>
                            <div class="col-span-3">
                                <p><strong>Award:</strong> {{ $degree->award }}</p>
                            </div>
                            <div class="col-span-3">
                                <p><strong>Major Subject:</strong> {{ $degree->major_subject }}</p>
                            </div>
                            <div class="col-span-3">
                                <p>
                                    <strong>Country Studied:</strong>
                                    {{ optional(\App\Models\Countries::find($degree->country))->name ?? 'Not Found' }}
                                </p>
                            </div>
                            <div class="col-span-6">
                                <p><strong>Certificate Attachment:</strong></p>
                                 <a href="{{ asset($degree->image_path) }}" target="_blank" class="btn btn-danger">
    <i class="fa fa-eye"></i> View
</a>
                                <a href="{{ asset($degree->image_path) }}" download class="btn btn-success">Download</a>
                            </div>
                        </div>
                        <hr class="my-3">
                    @empty
                        <p class="text-danger">No Degree Education Information available.</p>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- END: Master Education Information -->
 



        <!-- BEGIN: Guarantor Information -->
  <!--       <div class="intro-y box col-span-12">
            <div class="p-5">
                <h3 class="text-lg font-medium">Guarantor Information</h3>
                @forelse ($guarantorInfo as $guarantor)
                    <div class="grid grid-cols-12 gap-4 mt-2">
                        <div class="col-span-3">
                            <p><strong>Name:</strong> {{ $guarantor->name }}</p>
                        </div>
                        <div class="col-span-3">
                            <p><strong>Relationship:</strong> {{ $guarantor->relationship }}</p>
                        </div>
                        <div class="col-span-3">
                            <p><strong>Profession:</strong> {{ $guarantor->profession }}</p>
                        </div>
                        <div class="col-span-3">
                            <p><strong>Institution:</strong> {{ $guarantor->institution }}</p>
                        </div>
                        <div class="col-span-3">
                            <p>
                                <strong>Country:</strong>
                                {{ optional(\App\Models\Countries::find($guarantor->country))->name ?? 'Not Found' }}
                            </p>
                        </div>
                        <div class="col-span-3">
                            <p><strong>Mobile:</strong> {{ $guarantor->mobile }}</p>
                        </div>
                        <div class="col-span-3">
                            <p><strong>Email:</strong> {{ $guarantor->email }}</p>
                        </div>
                        <div class="col-span-3">
                            <p><strong>Address:</strong> {{ $guarantor->address }}</p>
                        </div>
                    </div>
                    <hr class="my-3">
                @empty
                    <p class="text-danger">No Guarantor Information available.</p>
                @endforelse
            </div>
        </div> -->
        <!-- END: Guarantor Information -->

        <!-- BEGIN: Financial Supporter Information -->
      <!--   <div class="intro-y box col-span-12">
            <div class="p-5">
                <h3 class="text-lg font-medium">Financial Supporter Information</h3>
                @forelse ($financialSupporter as $supporter)
                    <div class="grid grid-cols-12 gap-4 mt-2">
                        <div class="col-span-3">
                            <p><strong>Name:</strong> {{ $supporter->name }}</p>
                        </div>
                        <div class="col-span-3">
                            <p><strong>Relationship:</strong> {{ $supporter->relationship }}</p>
                        </div>
                        <div class="col-span-3">
                            <p><strong>Profession:</strong> {{ $supporter->profession }}</p>
                        </div>
                        <div class="col-span-3">
                            <p><strong>Institution:</strong> {{ $supporter->institution }}</p>
                        </div>
                        <div class="col-span-3">
                            <p>
                                <strong>Country:</strong>
                                {{ optional(\App\Models\Countries::find($supporter->country))->name ?? 'Not Found' }}
                            </p>
                        </div>
                        <div class="col-span-3">
                            <p><strong>Mobile:</strong> {{ $supporter->mobile }}</p>
                        </div>
                        <div class="col-span-3">
                            <p><strong>Email:</strong> {{ $supporter->email }}</p>
                        </div>
                        <div class="col-span-3">
                            <p><strong>Address:</strong> {{ $supporter->address }}</p>
                        </div>
                    </div>
                    <hr class="my-3">
                @empty
                    <p class="text-danger">No Financial Supporter Information available.</p>
                @endforelse
            </div>
        </div> -->
        <!-- END: Financial Supporter Information -->

        <!-- BEGIN: Attachments -->
        <div class="intro-y box col-span-12">
            <div class="p-5">
                <h3 class="text-lg font-medium">Attachments List</h3>
                <hr>
                @forelse ($attachments as $attach)
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-3">
                            <p>Study Plan Document</p>
                            <a href="{{ asset($attach->study_plan) }}" target="_blank" class="btn btn-danger">
    <i class="fa fa-eye"></i> View
</a>
                            <a href="{{ asset($attach->study_plan) }}" download class="btn btn-success"><i class="fa fa-download"></i> Download</a>
                        </div>
                        <div class="col-span-3">
                            <p>Curriculum Vitae (CV)</p>
                            <a href="{{ asset($attach->cv) }}" target="_blank" class="btn btn-danger">
    <i class="fa fa-eye"></i> View
</a>
                            <a href="{{ asset($attach->cv) }}" download class="btn btn-success"><i class="fa fa-download"></i> Download</a>
                        </div>
                        <div class="col-span-3">
                            <p>Police Clearance Document</p>
                            <a href="{{ asset($attach->police_clearance) }}" target="_blank" class="btn btn-danger">
    <i class="fa fa-eye"></i> View
</a>
                            <a href="{{ asset($attach->police_clearance) }}" download class="btn btn-success"><i class="fa fa-download"></i> Download</a>
                        </div>
  @if(isset($attachment->English_Certificate) && $attachment->English_Certificate !== null)
                        <div class="col-span-3">
                            <p>English  Certificate </p>
                            <a href="{{ asset($attach->English_Certificate) }}" target="_blank" class="btn btn-danger">
    <i class="fa fa-eye"></i> View
</a>
                            <a href="{{ asset($attach->English_Certificate) }}" download class="btn btn-success"><i class="fa fa-download"></i> Download</a>
                        </div>
                           @endif
                     <!--    <div class="col-span-3">
                            <p>Medical Report Document</p>
                            <a href="{{ asset($attach->medical_report) }}" target="_blank" class="btn btn-danger">
    <i class="fa fa-eye"></i> View
</a>
                            <a href="{{ asset($attach->medical_report) }}" download class="btn btn-success"><i class="fa fa-download"></i> Download</a>
                        </div> -->
                    </div>
                    <div class="grid grid-cols-12 gap-4 mt-4">
                        <div class="col-span-3">
                            <p>Bank Statement Document</p>
                            <a href="{{ asset($attach->bank_statement) }}" target="_blank" class="btn btn-danger">
    <i class="fa fa-eye"></i> View
</a>
                            <a href="{{ asset($attach->bank_statement) }}" download class="btn btn-success"><i class="fa fa-download"></i> Download</a>
                        </div>
                        <div class="col-span-3">
                            <p>Medical Form Document</p>
                            <a href="{{ asset($attach->medical_form) }}" target="_blank" class="btn btn-danger">
    <i class="fa fa-eye"></i> View
</a>
                            <a href="{{ asset($attach->medical_form) }}" download class="btn btn-success"><i class="fa fa-download"></i> Download</a>
                        </div>
                        <div class="col-span-3">
                            <p>Recommendation Letter</p>
                            <a href="{{ asset($attach->recomendation_letter) }}" target="_blank" class="btn btn-danger">
    <i class="fa fa-eye"></i> View
</a>
                            <a href="{{ asset($attach->recomendation_letter) }}" download class="btn btn-success"><i class="fa fa-download"></i> Download</a>
                        </div>






 @if(isset($attachment->Chinese_Certificate) && $attachment->Chinese_Certificate !== null)
                        <div class="col-span-3">
                            <p>Chinese Certificate </p>
                            <a href="{{ asset($attach->Chinese_Certificate) }}" target="_blank" class="btn btn-danger">
    <i class="fa fa-eye"></i> View
</a>
                            <a href="{{ asset($attach->Chinese_Certificate) }}" download class="btn btn-success"><i class="fa fa-download"></i> Download</a>
                        </div>
                          @endif
                             @if(isset($attachment->Achievements_Certificate) && $attachment->Achievements_Certificate !== null)
                         <div class="col-span-3">
                            <p>Achievements Certificate </p>
                            <a href="{{ asset($attach->Achievements_Certificate) }}" target="_blank" class="btn btn-danger">
    <i class="fa fa-eye"></i> View
</a>
                            <a href="{{ asset($attach->Achievements_Certificate) }}" download class="btn btn-success"><i class="fa fa-download"></i> Download</a>
                        </div>
                          @endif


                            <div class="col-span-3">
                            <p>Highest Transcript  Document</p>
                            <a href="{{ asset($attach->Highest_Transcript) }}" target="_blank" class="btn btn-danger">
    <i class="fa fa-eye"></i> View
</a>
                            <a href="{{ asset($attach->Highest_Transcript) }}" download class="btn btn-success"><i class="fa fa-download"></i> Download</a>
                        </div>
                    </div>
                    <hr class="my-3">
                @empty
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12">
                            <p class="h4 text-danger"><i class="align-middle me-2" data-feather="info"></i> No Information available</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- END: Attachments -->

      

        <!-- BEGIN: Applicant Contact Information (Home) -->
      <!--   <div class="intro-y box col-span-12">
            <div class="p-5">
                <h3 class="text-lg font-medium">Contact Information (Home)</h3>
                @forelse ($applicantHome as $home)
                    <div class="grid grid-cols-12 gap-4 mt-2">
                        <div class="col-span-3">
                            <p><strong>Mobile:</strong> {{ $home->phone }}</p>
                        </div>
                        <div class="col-span-3">
                            <p><strong>Alternate Mobile:</strong> {{ $home->alt_phone }}</p>
                        </div>
                        <div class="col-span-3">
                            <p><strong>Address:</strong> {{ $home->physical_address }}</p>
                        </div>
                    </div>
                    <hr class="my-3">
                @empty
                    <p class="text-danger">No Home Contact Information available.</p>
                @endforelse
            </div>
        </div> -->
        <!-- END: Applicant Contact Information (Home) -->

        <!-- BEGIN: Applied Scholarship -->
        <div class="intro-y box col-span-12">
            <div class="p-5">
                <h3 class="text-lg font-medium">Applied Scholarship</h3>
                <hr>
                @forelse ($applyScholarship as $scholar)
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12">
                            <p>
                                @php
                                    $scholarship = \App\Models\Scholarships::find($scholar->scholarship_id);
                                    echo 'COURSE: <b>' . strtoupper($scholarship->title) . '</b>';
                                    $institution = \App\Models\Institutions::find($scholarship->institution_id);
                                    echo 'UNIVERSITY NAME: <b>' . strtoupper($institution->name) . '</b>';
                                @endphp
                            </p>
                        </div>
                    </div>
                    <hr class="my-3">
                @empty
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12">
                            <p class="h4 text-danger"><i class="align-middle me-2" data-feather="info"></i> No Information available</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- END: Applied Scholarship -->

    </div>
@endsection
<script>
    function showReasonForm(id) {
        document.getElementById(`reasonForm-${id}`).style.display = 'block';
    }

    function hideReasonForm(id) {
        document.getElementById(`reasonForm-${id}`).style.display = 'none';
    }
</script>