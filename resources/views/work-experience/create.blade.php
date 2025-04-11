@extends('layouts.admin')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h1 class="h3 mb-3">Add Work Experience</h1>
                        </div>
                        <div class="col text-end">
                            <a href="{{ route('work-experience') }}" class="btn btn-success"><i class="align-middle me-2"
                                    data-feather="arrow-left"></i>Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <form>

                        <div class="row">

                            <div class="col-md-6">
                                <label>
                                    Do you have Work Experience?
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

                            <div class="col-md-6">
                                <label>
                                    Starting Date
                                </label>
                                <input type="date" name="fname" class="form-control" placeholder="Last Name">
                            </div>





                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <label>
                                    End Date
                                </label>
                                <input type="date" name="fname" class="form-control" placeholder="Passport #">
                            </div>

                            <div class="col-md-6">
                                <label>
                                    Working Institution
                                </label>
                                <input type="text" name="fname" class="form-control" placeholder="Working Institution">
                            </div>





                        </div>

                        <br>

                        <div class="row">

                            <div class="col-md-6">
                                <label>
                                    Position
                                </label>
                                <input type="date" name="fname" class="form-control" placeholder="Position">
                            </div>

                            <div class="col-md-6">
                                <label>
                                    Do you have working experience in China?
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
                        </div>

                        <br>

                        <button class="btn btn-primary"><i class="align-middle me-2" data-feather="save"></i>Save</button>

                    </form>





                </div>
            </div>




        </div>
    </main>
@endsection
