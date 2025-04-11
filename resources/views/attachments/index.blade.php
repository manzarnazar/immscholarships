@extends('layouts.admin')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">



            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h1 class="h3 mb-3">All Attachments List</h1>
                        </div>
                        <div class="col text-end">
                            <a href="{{ route('attachments-create') }}" class="btn btn-success"><i class="align-middle me-2"
                                    data-feather="plus"></i>Add Attachments</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush" id="dataTable">
                                <thead class="thead-light">
                                    <tr>
                                       
    
                                        <th>Study Plan</th>
                                        <th>CV</th>
                                        <th>Bank Statement</th>

                                        <th>Recomendation Letter</th>
                                        <th>Police Clearance</th>
                                        <th>Physical Exam</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
    
                                @foreach ($attachments as $item)
                                    <tr>
                                        <td><img src="{{ asset($item->study_plan) }}" width="80px" height="80px"></td>
                                        <td><img src="{{ asset($item->cv) }}" width="80px" height="80px"></td>
                                        <td><img src="{{ asset($item->recomendation_letter) }}" width="80px" height="80px"></td>

                                        <td><img src="{{ asset($item->police_clearance) }}" width="80px" height="80px"></td>
                                        <td><img src="{{ asset($item->bank_statement) }}" width="80px" height="80px"></td>
                                        <td><img src="{{ asset($item->physical_exam) }}" width="80px" height="80px"></td>

                                        <td><a class="btn btn-primary text-white"><i class="fa fa-download"></i></a>
                                           
                                            </td>
                                    </tr>
                                @endforeach
    
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
