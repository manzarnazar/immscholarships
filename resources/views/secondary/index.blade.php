@extends('layouts.admin')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="h3 mb-3">Secondary Education Information
                               
                            </h1>
                        </div>
                        <div class="col text-end">
                            <a href="{{ route('secondary-education-create') }}" class="btn btn-primary"><i
                                    class="align-middle me-2" data-feather="plus"></i>Add Info</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    @forelse ($secondary as $data)
                        
                  


                    <div class="row">

                        <div class="col-md-6">
                            <label>
                                Starting Date
                            </label>
                            <input type="date" name="fname" class="form-control" value="{{ $data->start_date }}" readonly>
                        </div>

                        <div class="col-md-6">
                            <label>
                                End Date
                            </label>
                            <input type="date" name="fname" class="form-control" value="{{ $data->end_date }}" readonly>
                        </div>





                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <label>
                                Institution Name
                            </label>
                            <input type="text" name="fname" class="form-control" value="{{ $data->institution_name }}"
                                readonly>
                        </div>

                        <div class="col-md-6">
                            <label>
                                Country/Regions
                            </label>
                            <input type="text" name="fname" class="form-control" value="@php
                            $country = \App\Models\Countries::find($data->country);
                            echo $country ? strtoupper($country->name) : 'Not Found';
                        @endphp"
                                readonly>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <label>
                                Major (Course Studied)
                            </label>
                            <input type="text" name="fname" class="form-control" value="{{ $data->major_subject }}"
                                readonly>
                        </div>

                        <div class="col-md-6">
                            <label>
                            Award Certificate
                            </label>
                            <input type="text" name="fname" class="form-control" value="{{ $data->award }}" readonly>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <label>
                                Have you ever Study in China?
                            </label>
                            <input type="text" name="fname" class="form-control" placeholder="{{ $data->study_in_china ?? 'Null' }}" readonly>
                        </div>


                    </div>

                    <br>

                    <div class="row">

                           

                        <div class="col-md-12">
                            <p class="text text-success">Certificate/Transcript Attachment File</p>

                            <hr>
                    
                            <a class="btn btn-info" href=" {{ asset($data->image_path) }}" ><i class="fa fa-download"></i> Download</a>
                        </div>

                    </div>

                    @empty
                    <div class="row">
                        <div class="col-md-12">
                            <p class="h4 text-danger"><i class="align-middle me-2"
                                data-feather="info"></i> No Information available</p>
                        </div>
                    </div>
                @endforelse


                </div>
            </div>




        </div>
    </main>
@endsection
