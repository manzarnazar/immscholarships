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
                            <h1 class="h3 mb-3">Add New Course</h1>
                        </div>
                        <div class="col text-end">
                            <a href="{{ route('admin-scholarships') }}" class="btn btn-success"><i class="align-middle me-2"
                                    data-feather="arrow-left"></i>Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <form id="categoryForm" method="POST" action="{{ route('admin-scholarships-store') }}"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="row">

                            <div class="col-md-6">
                                <label>
                                    Course Name
                                </label>
                                <input type="text" name="title" id="title" class="form-control"
                                    placeholder="Course Name">
                            </div>

                           
                                <div class="col-md-6">
                                    <label>
                                        University 
                                    </label>
                                    <?php
                                    use App\Models\Institutions;
                                    $categories = Institutions::pluck('name', 'id');
                                    ?>
    
                                    <select name="institution_id" id="institution_id"
                                        class="form-control show-tick ms select2" data-placeholder="Select">
                                        <option value="">Select University</option>
                                        <?php foreach ($categories as $id => $category): ?>
                                        <option value="<?= $id ?>"><?= strtoupper($category) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                        </div>

                      

                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <label>
                                    Description
                                </label>
                                <textarea type="text" id="description" name="description" class="form-control" placeholder="Description"></textarea>
                            </div>
                        </div>
                        <br>

                        <div class="row">

                            <div class="col-md-6">
                                <label>
                                   Teaching Language
                                </label>

                                <select class="form-control" id="teaching_language" name="teaching_language">

                                    <option value="">Tap to select</option>
                                    <option value="chinese">CHINESE</option>
                                    <option value="english">ENGLISH</option>
                                    <option value="russian">RUSSIAN</option>


                                </select>
                              
                            </div>

                            <div class="col-md-6">
                                <label>
                                    Cover Image
                                </label>
                                <input type="file" name="image_path" id="image_path" class="form-control"
                                    placeholder="Physical Address">
                            </div>


                        </div>



                        <br>

                        <button type="submit" class="btn btn-primary"><i class="align-middle me-2"
                                data-feather="save"></i>Save</button>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

{{-- @section('scripts')
    <script>
        $(document).ready(function() {

            $("#categoryForm").validate({

                rules: {
                    title: "required",
                    category_id: "required",
                    duration: "required",
                    degree: "required",
                    institutions_id: "required",
                    image_path: "required",
                    description: "required",

                },

                messages: {
                    title: "Title is required",
                    category_id: "Select Category",
                    duration: "Duration is required",
                    degree: "Select Education Level",
                    institutions_id: "Select Institution",
                    image_path: "Select Cover Image",
                    description: "Description is required"
                },

                submitHandler: function(form) {
                    sendAjaxRequest();
                }
            });

            function sendAjaxRequest() {

                $.ajax({
                    url: "{{ route('admin-scholarships-store') }}",
                    data: $('#categoryForm').serialize(),
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    beforeSend: function() {
                        $('#loading-overlay').show();
                    },


                    success: function(result) {
                        if(result.success){
                            window.location.href = "{{ route('admin-scholarships') }}";
                        } else{
                            alert('Server Error 302');
                        }
                   
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
@endsection --}}
