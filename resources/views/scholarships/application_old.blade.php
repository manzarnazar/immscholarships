@extends('layouts.admin')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Review Applicant Informations</h1>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title mb-0 text-primary">Personal Informations | Applicant</h5>
                                    <br>
                                    @foreach ($student as $item)
                                        <small>
                                            <img src="{{ asset($item->image_path) ?? asset('default.jpg') }}" width="100px"
                                                height="100px">
                                        </small>
                                    @endforeach
                                </div>
                                <div class="col text-end">
                                    @foreach ($scholarApplication as $item)
                                        @if ($item->status == 'pending')
                                            <a href="{{ route('scholarship-approve', ['id' => $item->id]) }}"
                                                class="btn btn-primary"><i class="fa fa-check"></i> Approve</a>
                                            <a href="{{ route('scholarship-reject', ['id' => $item->id]) }}"
                                                class="btn btn-danger"><i class="fa fa-close"></i> Reject</a>
                                        @endif
                                    @endforeach
                                    <a onclick="window.print()" class="btn btn-info"><i class="fa fa-print"></i> Print
                                        Application</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @forelse ($scholarApplication as $item)
                                <div class="row">
                                    <div class="col-md-12">
                                        Application ID:
                                        <span class="badge bg-success">
                                            {{ $item->application_id }}
                                        </span>
                                        | Date Appllied: <strong> {{ $item->created_at->format('F j, Y \a\t g:i A') }}
                                        </strong> | Highest Education LeveL : <strong>
                                            @foreach ($student as $stu)
                                                {{ strtoupper($stu->highest_education) }}
                                            @endforeach
                                        </strong> | Application Status: <strong>{{ strtoupper($item->status) }}</strong>
                                    </div>
                                </div>
                            @empty
                                No Data Available!
                            @endforelse
                            <hr>
                            @forelse ($student as $data)
                                <div class="row">
                                    <div class="col-md-3">
                                        <p>Full Name: <strong>{{ strtoupper($data->first_name) }},
                                                {{ strtoupper($data->last_name) }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Sex: <strong>{{ strtoupper($data->gender) }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Date of Birth: <strong>{{ $data->dob }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Place of Birth: <strong>
                                                @php
                                                    $country = \App\Models\Countries::find($data->country_of_birth);
                                                    echo $country ? $country->name : 'Not Found';
                                                @endphp
                                            </strong></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <p>Marital Status: <strong>{{ strtoupper($data->marital_status) }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Mobile Number: <strong>{{ $data->mobile }}</strong> </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Country of Origin: <strong>
                                                @php
                                                    $country = \App\Models\Countries::find($data->country_origin);
                                                    echo $country ? $country->name : 'Not Found';
                                                @endphp
                                            </strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Highest Education: <strong>{{ strtoupper($data->highest_education) }}</strong>
                                        </p>
                                    </div>
                                </div>
                                <br>
                            @empty
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="h4 text-danger"><i class="align-middle me-2" data-feather="info"></i> No
                                            Information available</p>
                                    </div>
                                </div>
                            @endforelse
                            <h5 class="card-title mb-0 text-primary">Passport Informations</h5>
                            <hr>
                            @forelse ($passport as $pass)
                                <div class="row">
                                    <div class="col-md-3">
                                        <p>Passport Number: <strong>{{ $pass->passport_number }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Passport Expiry Date: <strong>{{ $pass->expiry_date }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Last Name: <strong>{{ $pass->last_name }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>First Name: <strong>{{ $pass->first_name }}</strong></p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="text text-success">Certificate Attachment</p>
                                        <a href="{{ asset($pass->image_path) ?? asset('default.jpg') }}"
                                            class="btn btn-primary"><i class="fa fa-download"></i> Download</a>
                                    </div>
                                </div>
                            @empty
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="h4 text-danger"><i class="align-middle me-2" data-feather="info"></i> No
                                            Information available</p>
                                    </div>
                                </div>
                            @endforelse
                            <br>
                            <h5 class="card-title mb-0 text-primary">Secondary Education Informations</h5>
                            <hr>
                            @forelse ($secondaryEducation as $secondary)
                                <div class="row">
                                    <div class="col-md-3">
                                        <p>Institution/School Name: <strong>{{ $secondary->institution_name }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Start Date: <strong>{{ $secondary->start_date }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>End Date: <strong>{{ $secondary->end_date }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Award: <strong>{{ $secondary->award }}</strong></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <p>Major Subject: <strong>{{ $secondary->major_subject }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Country Studied: <strong> @php
                                            $country = \App\Models\Countries::find($secondary->country);
                                            echo $country ? $country->name : 'Not Found';
                                        @endphp</strong></p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="text text-success">Certificate Attachment</p>
                                        <a href="{{ asset($secondary->image_path) ?? asset('default.jpg') }}"
                                            class="btn btn-primary"><i class="fa fa-download"></i> Download</a>
                                    </div>
                                </div>
                            @empty
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="h4 text-danger"><i class="align-middle me-2" data-feather="info"></i> No
                                            Information available</p>
                                    </div>
                                </div>
                            @endforelse
                            <br>
                            <h5 class="card-title mb-0 text-primary">Highschool/Diploma Education Informations</h5>
                            <hr>
                            @forelse ($diplomaEducation as $diploma)
                                <div class="row">
                                    <div class="col-md-3">
                                        <p>Institution/School Name: <strong>{{ $diploma->institution_name }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Start Date: <strong>{{ $diploma->start_date }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>End Date: <strong>{{ $diploma->end_date }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Award: <strong>{{ $diploma->award }}</strong></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <p>Major Subject: <strong>{{ $diploma->major_subject }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Country Studied: <strong>@php
                                            $country = \App\Models\Countries::find($diploma->country);
                                            echo $country ? $country->name : 'Not Found';
                                        @endphp</strong></strong></p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="text text-success">Certificate Attachment</p>
                                        <a href="{{ asset($diploma->image_path) ?? asset('default.jpg') }}"
                                            class="btn btn-primary"><i class="fa fa-download"></i> Download</a>
                                    </div>
                                </div>
                            @empty
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="h4 text-danger"><i class="align-middle me-2" data-feather="info"></i> No
                                            Information available</p>
                                    </div>
                                </div>
                            @endforelse
                            <br>
                            <h5 class="card-title mb-0 text-primary">Degree Education Informations</h5>
                            <hr>
                            @forelse ($degreeEducation as  $degree)
                                <div class="row">
                                    <div class="col-md-3">
                                        <p>Institution/School Name: <strong>{{ $degree->institution_name }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Start Date: <strong>{{ $degree->start_date }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>End Date: <strong>{{ $degree->end_date }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Award: <strong>{{ $degree->award }}</strong></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <p>Major Subject: <strong>{{ $degree->major_subject }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Country Studied: <strong>@php
                                            $country = \App\Models\Countries::find($degree->country);
                                            echo $country ? $country->name : 'Not Found';
                                        @endphp</strong></strong></p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="text text-success">Certificate Attachment</p>
                                        <a href="{{ asset($degree->image_path) ?? asset('default.jpg') }}"
                                            class="btn btn-primary"><i class="fa fa-download"></i> Download</a>
                                    </div>
                                </div>
                            @empty
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="h4 text-danger"><i class="align-middle me-2" data-feather="info"></i>
                                            No
                                            Information available</p>
                                    </div>
                                </div>
                            @endforelse
                            <br>
                            <h5 class="card-title mb-0 text-primary">Guarantor Informations</h5>
                            <hr>
                            @forelse ($guarantorInfo as $gu)
                                <div class="row">
                                    <div class="col-md-3">
                                        <p>Full Name: <strong>{{ $gu->name }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Relationship: <strong>{{ $gu->relationship }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Profession: <strong>{{ $gu->profession }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Work Institution: <strong>{{ $gu->institution }}</strong></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <p>Country: <strong>@php
                                            $country = \App\Models\Countries::find($gu->country);
                                            echo $country ? $country->name : 'Not Found';
                                        @endphp</strong></strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Mobile Number: <strong>{{ $gu->mobile }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Email Address: <strong>{{ $gu->email }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Physical Address: <strong>{{ $gu->address }}</strong></p>
                                    </div>
                                </div>
                            @empty
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="h4 text-danger"><i class="align-middle me-2" data-feather="info"></i>
                                            No Information available</p>
                                    </div>
                                </div>
                            @endforelse
                            <br>
                            <h5 class="card-title mb-0 text-primary">Financial Supporter Informations</h5>
                            <hr>
                            @forelse ($financialSupporter as $finance)
                                <div class="row">
                                    <div class="col-md-3">
                                        <p>Full Name: <strong>{{ $finance->name }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Relationship: <strong>{{ $finance->relationship }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Profession: <strong>{{ $finance->profession }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Work Institution: <strong>{{ $finance->work_institution }}</strong></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <p>Country: <strong>@php
                                            $country = \App\Models\Countries::find($finance->country);
                                            echo $country ? $country->name : 'Not Found';
                                        @endphp</strong></strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Mobile Number: <strong>{{ $finance->mobile }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Email Address: <strong>{{ $finance->email }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Physical Address: <strong>{{ $finance->address }}</strong></p>
                                    </div>
                                </div>
                            @empty
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="h4 text-danger"><i class="align-middle me-2" data-feather="info"></i>
                                            No Information available</p>
                                    </div>
                                </div>
                            @endforelse
                            <br>
                            <h5 class="card-title mb-0 text-primary">Contact Informations (Applicant) </h5>
                            <hr>
                            @forelse ($applicantContact as $contact)
                                <div class="row">
                                    <div class="col-md-3">
                                        <p>Mobile Number: <strong>{{ $contact->phone }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Email Address: <strong>{{ $contact->email }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Current Address: <strong>{{ $contact->physical_address }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Postal Code: <strong>{{ $contact->postcode }}</strong></p>
                                    </div>
                                </div>
                            @empty
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="h4 text-danger"><i class="align-middle me-2" data-feather="info"></i>
                                            No Information available</p>
                                    </div>
                                </div>
                            @endforelse
                            <br>
                            <h5 class="card-title mb-0 text-primary">Contact Informations (Home) </h5>
                            <hr>
                            @forelse ($applicantHome as $home)
                                <div class="row">
                                    <div class="col-md-3">
                                        <p>Mobile Number: <strong>{{ $home->phone }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Email Address: <strong>{{ $home->email }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Current Address: <strong>{{ $home->physical_address }}</strong></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Postal Code: <strong>{{ $data->postcode }}</strong></p>
                                    </div>
                                </div>
                            @empty
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="h4 text-danger"><i class="align-middle me-2" data-feather="info"></i>
                                            No Information available</p>
                                    </div>
                                </div>
                            @endforelse
                            <br>
                            <h5 class="card-title mb-0 text-primary">Attachments List</h5>
                            <hr>
                            @forelse ($attachments as $attach)
                                <div class="row">
                                    <div class="col-md-3">
                                        <p>Study Plan Document</p>
                                        <a href="{{ asset($attach->study_plan) }}" class="btn btn-success"><i
                                                class="fa fa-download"></i> Download</a>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Curricullum Vitae (CV)</p>
                                        <a href="{{ asset($attach->cv) }}" class="btn btn-success"><i
                                                class="fa fa-download"></i> Download</a>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Police Clearance Document</strong></p>
                                        <a href="{{ asset($attach->police_clearance) }}" class="btn btn-success"><i
                                                class="fa fa-download"></i> Download</a>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Medical Report Document</p>
                                        <a href="{{ asset($attach->study_plan) }}" class="btn btn-success"><i
                                                class="fa fa-download"></i> Download</a>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <p>Bank Statement Document</p>
                                        <a href="{{ asset($attach->bank_statement) }}" class="btn btn-success"><i
                                                class="fa fa-download"></i> Download</a>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Medical Form Document</p>
                                        <a href="{{ asset($attach->medical_form) }}" class="btn btn-success"><i
                                                class="fa fa-download"></i> Download</a>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Recomendation Letter</strong></p>
                                        <a href="{{ asset($attach->recomendation_letter) }}" class="btn btn-success"><i
                                                class="fa fa-download"></i> Download</a>
                                    </div>
                                </div>
                            @empty
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="h4 text-danger"><i class="align-middle me-2" data-feather="info"></i>
                                            No Information available</p>
                                    </div>
                                </div>
                            @endforelse
                            <br>
                            <h5 class="card-title mb-0 text-primary">Applied Scholarship</h5>
                            <hr>
                            @forelse ($applyScholarship as $scholar)
                            <div class="row">
                                <p>
                                    @php
                                        $scholarship = \App\Models\Scholarships::find($scholar->scholarship_id);
                                        echo 'COURSE: <b>'.strtoupper($scholarship->title). ' </b>';
                                        $institution = \App\Models\Institutions::find($scholarship->institution_id);
                                        echo 'UNIVERSITY NAME: <b> '. strtoupper($institution->name);
                                    @endphp
                                </p>
                            </div>
                            @empty
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="h4 text-danger"><i class="align-middle me-2" data-feather="info"></i>
                                        No Information available</p>
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
