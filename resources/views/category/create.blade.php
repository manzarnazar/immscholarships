@extends('../layout/' . $layout)

@section('subhead')
    <title>IMS - Scholarship Portal</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Add Scholarship Category</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Input -->
            <div class="intro-y box">
                <div
                    class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Add Scholarship Category</h2>
                    <a href="{{ route('category-index') }}" class="btn btn-success py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">{{ __('All Categories') }}</a>

                </div>
                <div id="inline-form" class="p-5">
                    <form id="categoryForm" method="POST" action="{{ route('category-store') }}">
                        @csrf
                        <div class="preview">
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <label for="regular-form-1" class="form-label">Category Name</label>
                                    <input type="text" class="form-control col-span-4" id="name" name="name"
                                        placeholder="Category Name" aria-label="Category Name">
                                    <div class="error"></div>
                                </div>
                                <div>
                                    <label for="regular-form-2" class="form-label">Description</label>
                                    <textarea class="form-control col-span-4" rows="5" id="description_category" name="description_category"></textarea>
                                    <div class="error"></div>
                                </div>
                            </div>
                        </div>
                        <button id="category-save"
                            class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">{{ __('Save') }}</button>
                    </form>
                </div>

            </div>
            <!-- END: Input -->

        </div>

    </div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        // Initialize form validation
        $("#categoryForm").validate({
            rules: {
                name: "required",
                description_category: "required",
            },
            messages: {
                name: "Category Name is required",
                description_category: "Description is required"
            },
            showErrors: function(errorMap, errorList) {
                if (errorList.length > 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: errorList.map(error => error.message).join('<br>'),
                    });
                }
            },
            submitHandler: function(form) {
                sendAjaxRequest();
            }
        });

        // Prevent default form submission and handle with AJAX if valid
        $('#category-save').click(function(e) {
            e.preventDefault();
            if ($("#categoryForm").valid()) {
                $("#categoryForm").submit();
            }
        });

        function sendAjaxRequest() {
            $.ajax({
                url: "{{ route('category-store') }}",
                data: $('#categoryForm').serialize(),
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('#loading-overlay').show();
                },
                success: function(result) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Category added successfully',
                        onClose: function() {
                            window.location.href = "{{ route('category-index') }}";
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Ajax request failed:', xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error adding data. Please try again.'
                    });
                },
                complete: function() {
                    $('#loading-overlay').hide();
                }
            });
        }
    });
    </script>


@endsection
