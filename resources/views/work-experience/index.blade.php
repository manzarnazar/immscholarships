@extends('layouts.admin')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h1 class="h3 mb-3">Work Experience Information</h1>
                        </div>
                        <div class="col text-end">
                            <a href="{{ route('work-experience-create') }}" class="btn btn-primary"><i class="align-middle me-2" data-feather="plus"></i>Add Info</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                      
                        <div class="col-md-6">
                            <label>
                                Have Work Experience?
                            </label>
                            <input type="text" name="fname" class="form-control" placeholder="Yes/No" readonly>
                        </div>

                        <div class="col-md-6">
                            <label>
                                Starting Date
                            </label>
                            <input type="date" name="fname" class="form-control" placeholder="Last Name" readonly>
                        </div>

                     



                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <label>
                               End Date
                            </label>
                            <input type="date" name="fname" class="form-control" placeholder="Passport #" readonly>
                        </div>

                        <div class="col-md-6">
                            <label>
                               Working Institution
                            </label>
                            <input type="text" name="fname" class="form-control" placeholder="Working Institution"
                                readonly>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <label>
                              Position
                            </label>
                            <input type="date" name="fname" class="form-control" placeholder="Position" readonly>
                        </div>

                        <div class="col-md-6">
                            <label>
                               Working Experience in China?
                            </label>
                            <input type="text" name="fname" class="form-control" placeholder="Yes / No"
                                readonly>
                        </div>
                    </div>
                 

                   
                    
                </div>
            </div>




        </div>
    </main>
@endsection
