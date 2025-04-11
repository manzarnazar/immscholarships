@extends('layouts.admin')

@section('content')


    <main class="content">
        <div class="container-fluid p-0">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h1 class="h3 mb-3">Add Passport Information</h1>
                        </div>
                        <div class="col text-end">
                            <a href="{{ route('passport-info') }}" class="btn btn-success"><i class="align-middle me-2" data-feather="arrow-left"></i>Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('passport-info-store')}}" enctype="multipart/form-data">

                        @csrf

                    <div class="row">
                     
                        <div class="col-md-3">
                            <label><span style="color: red">*</span>
                                Passport Last Name
                            </label>
                            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name">
                        </div>

                        <div class="col-md-3">
                            <label><span style="color: red">*</span>
                                Passport First Name
                            </label>
                            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name">
                        </div>
                        
                          <div class="col-md-3">
                            <label><span style="color: red">*</span>
                                Passport Number
                            </label>
                            <input type="text" name="passport_number" id="passport_number" class="form-control" placeholder="Passport #">
                        </div>

                        <div class="col-md-3">
                            <label><span style="color: red">*</span>
                                Passport Issued Date
                            </label>
                            <input type="date" name="issued_date" id="issued_date" class="form-control" placeholder="12/02/2026"
                                >
                        </div>

                     



                    </div>

                
                    <br>

                    <div class="row">

                        <div class="col-md-3">
                            <label><span style="color: red">*</span>
                                Passport Expiry Date
                            </label>
                            <input type="date" name="expiry_date" id="expiry_date" class="form-control" placeholder="12/02/2026"
                                >
                        </div>
                        
                         <div class="col-md-3">
                            <label>
                                Immigration Information (Whether Immigrated form Mainland China or HongKong, Macao and Taiwan)
                            </label>

                            <br>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="yesCheckbox" value="yes">
                                <label class="form-check-label" for="yesCheckbox">Yes</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="noCheckbox" value="no">
                                <label class="form-check-label" for="noCheckbox">No</label>
                              </div>
                              
                        </div>
                        
                         <div class="col-md-3">
                            <label><span style="color: red">*</span>
                               Passport Image (JPG,PNG Only)
                            </label>
                            
                            <input type="file" name="image_path" id="image_path">
                              
                        </div>

                    </div>

                  
                    <br>

                    <button class="btn btn-primary" type="submit"><i class="align-middle me-2" data-feather="save"></i>Save</button>

                </form>  
                </div>
            </div>
        </div>
    </main>
@endsection


