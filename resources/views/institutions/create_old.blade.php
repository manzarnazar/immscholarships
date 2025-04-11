@extends('layouts.admin')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <!-- Loading overlay -->
            <div id="loading-overlay"
                style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 255, 255, 0.7); z-index: 9999;">
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                    <img src="{{ asset('loading.gif') }}" alt="Loading spinner">
                </div>
            </div>


            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h1 class="h3 mb-3">Add New Institution</h1>
                        </div>
                        <div class="col text-end">
                            <a href="{{ route('admin-institutions') }}" class="btn btn-success"><i class="align-middle me-2"
                                    data-feather="arrow-back"></i>Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form id="categoryForm" method="POST" action="{{ route('admin-institutions-store') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><span style="color: red">*</span> University Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="University Name">

                                        <div class="error"></div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><span style="color: red">*</span> Country</label>
                                        <?php
                                        use App\Models\Countries;
                                        $airports = Countries::pluck('name', 'id');
                                        ?>

                                        <select name="country" id="country" class="form-control">
                                            <option value="">Select Country</option>

                                            <?php foreach ($airports as $name): ?>
                                            <option value="<?= $name ?>">
                                                <?= strtoupper($name) ?>

                                            </option>
                                            <?php endforeach ?>
                                        </select>
                                        <div class="error"></div>
                                    </div>
                                </div>

                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><span style="color: red">*</span>Province</label>
                                        <input type="text" class="form-control" id="province" name="province"
                                            placeholder="Province">

                                        <div class="error"></div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><span style="color: red">*</span> City Name</label>
                                        <input type="text" class="form-control" id="city" name="city"
                                            placeholder="City Name">
                                        <div class="error"></div>
                                    </div>
                                </div>

                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><span style="color: red">*</span>Education Level</label>

                                        <select class="form-control" id="education_level" name="education_level">
                                            <option value="">Select Education Level</option>
                                            <option value="masters">MASTERS DEGREE</option>
                                            <option value="bachelor">BACHELOR DEGREE</option>
                                            <option value="language program">LANGUAGE PROGRAM</option>


                                        </select>

                                        <div class="error"></div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><span style="color: red">*</span> Duration</label>
                                        <input type="text" class="form-control" id="duration" name="duration"
                                            placeholder="Duration eg: 4yrs">
                                        <div class="error"></div>
                                    </div>
                                </div>

                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><span style="color: red">*</span>Application Timeline</label>
                                        <textarea type="text" class="form-control" id="timeline" name="timeline"
                                            placeholder="Timeline"></textarea>

                                        <div class="error"></div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><span style="color: red">*</span>Fees</label>
                                        <textarea type="text" class="form-control" id="application_fee"
                                            name="application_fee" placeholder="Fees"></textarea>

                                        <div class="error"></div>

                                    </div>
                                </div>



                            </div>

                            <br>

                            <div class="row">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><span style="color: red">*</span>IMS Service Fee</label>
                                        <textarea type="text" class="form-control" id="ims_fee" name="ims_fee"
                                            placeholder="Service Fees"></textarea>
                                        <div class="error"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><span style="color: red">*</span>Scholarships</label>
                                        <textarea type="text" class="form-control" id="scholarship" name="scholarship"
                                            placeholder="Service Fees"></textarea>
                                        <div class="error"></div>
                                    </div>
                                </div>

                            </div>


                            <br>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><span style="color: red">*</span> Admission Requirements</label>
                                        <textarea type="text" class="form-control" id="requirements" name="requirements"
                                            placeholder="Requirements"></textarea>
                                        <div class="error"></div>
                                    </div>
                                </div>
                            </div>

                            <br>



                            <button id="btn" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#btn').click(function() {
                // e.preventDefault();
                dataValidation();
            });


            function dataValidation() {

                $("#categoryForm").validate({

                    rules: {
                        name: "required",
                        phone: {
                            required: true,
                            minlength: 10
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        address: "required",
                    },

                    messages: {
                        name: "Institution Name is required",
                        phone: "Invalid Phone Number",
                        email: "Email Address is required",
                        address: "Physical address is required"
                    },

                    submitHandler: function(form) {
                        sendAjaxRequest();
                    }
                });

            }


            function sendAjaxRequest() {

                $.ajax({
                    url: "{{ route('admin-institutions-store') }}",
                    data: $('#categoryForm').serialize(),
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    beforeSend: function() {
                        $('#loading-overlay').show();
                    },


                    success: function(result) {
                        window.location.href = "{{ route('admin-institutions') }}";
                    },
                    error: function(xhr, status, error) {
                        console.error('Ajax request failed:', xhr.responseText);
                        alert('Error adding data. Please try again.');
                    },
                    complete: function() {
                        $('#loading-overlay').hide();
                    }
                });

            }

        });
    </script>
@endsection
