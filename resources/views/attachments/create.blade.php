@extends('layouts.admin')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">



            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h1 class="h3 mb-3">Upload Attachments (All Required)</h1>
                        </div>
                        <div class="col text-end">
                            <a href="{{ route('attachments-index') }}" class="btn btn-success"><i class="align-middle me-2"
                                    data-feather="arrow-back"></i>Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form id="categoryForm" method="POST" action="{{ route('attachments-store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><span style="color: red">*</span> Study Plans
                                            (PDF only, <strong>Maximum size 5MB </strong>)</label>
                                        <input type="file" class="form-control" id="study_plan" name="study_plan" placeholder="Category Name" accept="application/pdf">
                                        <div class="error"></div>
                            
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><span style="color: red">*</span> Bank Statement
                                            Certificate (JPEG,PNG only, <strong>Maximum size 5MB </strong>)</label>
                                        <input type="file" class="form-control" id="bank_statement" name="bank_statement"
                                            placeholder="Category Name" accept="image/*">
                            
                                        <div class="error"></div>
                            
                                    </div>
                                </div>
                            
                              
                            
                            </div>
                            
                            <br>
                            
                          
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><span style="color: red">*</span> Recomendention Letter (PDF
                                            only, <strong>Maximum size 5MB </strong>)</label>
                                        <input type="file" class="form-control" id="recomendation_letter" name="recomendation_letter" placeholder="Category Name" accept="application/pdf">
                            
                                        <div class="error"></div>
                            
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><span style="color: red">*</span> Police Clearance (PDF
                                            only, <strong>Maximum size 5MB </strong>)</label>
                                        <input type="file" class="form-control" id="police_clearance" name="police_clearance" placeholder="Category Name" accept="application/pdf">
                            
                                        <div class="error"></div>
                            
                                    </div>
                                </div>
                            
                              
                            
                            </div>
                            
                           

                            <br>

                            <div class="row">
                               <!--  <div class="col-md-6">
                                    <div class="form-group">
                                        <label><span style="color: red">*</span> Physical Exams Certificate (PDF
                                            only, <strong>Maximum size 5MB </strong>)</label>
                                        <input type="file" class="form-control" id="physical_exam" name="physical_exam" placeholder="Category Name" accept="application/pdf">
                            
                                        <div class="error"></div>
                            
                                    </div>
                                </div> -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><span style="color: red">*</span> Curicullum Vitae (CV) (PDF
                                            only, <strong>Maximum size 5MB </strong>)</label>
                                        <input type="file" class="form-control" id="cv" name="cv" placeholder="Category Name" accept="application/pdf">
                            
                                        <div class="error"></div>
                            
                                    </div>
                                </div>
                            
                               
                            
                            </div>

                            <br>

                            <hr>

                            <p> >>> Please Download <strong style="color: red"> Medical Examination Form </strong> below, Make sure all details is filled by Physician in <strong> Government Hospital/Dispensary and Signed. </strong></p>

                            <a href="{{ route('download-medical-form') }}" class="btn btn-success"><i class="fa fa-download"></i> Download</a>

                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><span style="color: red">*</span> Medical Examination Form (Signed) (PDF
                                            only, <strong>Maximum size 5MB </strong>)</label>
                                        <input type="file" class="form-control" id="medical_form" name="medical_form" placeholder="Category Name" accept="application/pdf">
                            
                                        <div class="error"></div>
                            
                                    </div>
                                </div>
                            </div>

                           
                            <br>



                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
