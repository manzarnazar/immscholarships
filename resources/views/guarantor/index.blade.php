@extends('layouts.admin')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h1 class="h3 mb-3">Guarantor Information</h1>
                        </div>
                        <div class="col text-end">
                            <a href="{{ route('guarantor-create') }}" class="btn btn-primary"><i class="align-middle me-2"
                                    data-feather="plus" id="addInfoBtn" name="addInfoBtn"></i>Add Info</a>

                            <a href="{{ route('guarantor-create') }}" class="btn btn-success"><i
                                    class="align-middle me-2" data-feather="edit"></i>Edit Info</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    @forelse ($guarantor as $pass)
                        <div class="row">

                            <div class="col-md-6">
                                <label>
                                    Full Name
                                </label>
                                <input type="text" name="fname" class="form-control"
                                    value="{{ strtoupper($pass->name) }}" readonly>
                            </div>

                            <div class="col-md-6">
                                <label>
                                    Relationship
                                </label>
                                <input type="text" name="fname" class="form-control"
                                    value="{{ strtoupper($pass->relationship) }}" readonly>
                            </div>





                        </div>

                        <br>


                        <div class="row">
                            <div class="col-md-6">
                                <label>
                                    Profession
                                </label>
                                <input type="text" name="fname" class="form-control"
                                    value="{{ $pass->profession }}" readonly>
                            </div>

                            <div class="col-md-6">
                                <label>
                                    Work Station
                                </label>
                                <input type="text" name="fname" class="form-control" value="{{ $pass->work_institution }}"
                                    readonly>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <label>
                                    Email Address
                                </label>
                                <input type="text" name="fname" class="form-control"
                                    value="{{ $pass->email }}" readonly>
                            </div>

                            <div class="col-md-6">
                                <label>
                                    Physical Address
                                </label>
                                <input type="text" name="fname" class="form-control" value="{{ $pass->address }}"
                                    readonly>
                            </div>
                        </div>


                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <label>
                                    Country/Region
                                </label>
                                <input type="text" name="fname" class="form-control"
                                    value="{{ $pass->country }}" readonly>
                            </div>

                            <div class="col-md-6">
                                <label>
                                   Mobile Number
                                </label>
                                <input type="text" name="fname" class="form-control" value="{{ $pass->mobile }}"
                                    readonly>
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

@section('scripts')
    <script>
        function checkFields() {
            var allFieldsFilled = true;
            $('input[type="text"], input[type="date"]').each(function() {
                if ($(this).val() === '') {
                    allFieldsFilled = false;
                    return false;
                }
            });

            if (allFieldsFilled) {
                $('#addInfoBtn').hide();
            } else {
                $('#addInfoBtn').show();
            }
        }

        $(document).ready(function() {
            checkFields();

            $('input[type="text"], input[type="date"]').on('input', function() {
                checkFields();
            });
        });
    </script>
@endsection
