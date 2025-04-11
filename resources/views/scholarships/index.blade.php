@extends('../layout/' . $layout)

@section('subhead')
    <title>IMS - Scholarship Portal</title>
@endsection

@section('subcontent')
<div class="col-12 flex justify-between items-center">
    <h2 class="intro-y text-lg font-medium mt-10">All Courses Available</h2>
    <div class="flex items-center">
        <a href="{{ route('admin-scholarships-create') }}" class="btn btn-success">
            <i class="align-middle me-2" data-feather="plus"></i> Add Course
        </a>
    </div>
</div>

    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <div class="hidden md:block mx-auto text-slate-500" id="entries-info"></div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <input type="text" id="search" class="form-control w-56 box pr-10" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search" style="cursor: pointer;"></i>
                </div>
            </div>

          
        </div>
<div class="gap-6 mt-5">
    <form action="{{ route('admin-printprogram') }}" method="GET" target="_blank">
        <select name="status" class="form-select">
            <option value="">All</option>
            <option value="AVAILABLE">Available</option>
            <option value="not available">Not Available</option>
        </select>
        <button type="submit" class="btn btn-primary mt-3">Print</button>
    </form>
</div>

        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Course Title</th>
                        <th class="whitespace-nowrap">University Name</th>
                        <th class="whitespace-nowrap">Image</th>
                        <th class="whitespace-nowrap">Status</th>
                        <!-- <th class="whitespace-nowrap">Created At</th> -->
                        <th class="text-center whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody id="course-data">
                    @include('scholarships.partials._table_data')
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->

        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                <ul class="pagination" id="pagination">
                    @include('layout.components.pagination', ['paginator' => $scholarships])
                </ul>
            </nav>
            <select id="entries-per-page" class="w-20 form-select box mt-3 sm:mt-0">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="35">35</option>
                <option value="50">50</option>
            </select>
        </div>
        <!-- END: Pagination -->
    </div>
<!-- BEGIN: Delete Confirmation Modal -->
<div id="delete-confirmation-modal" class="fixed inset-0 z-[200] hidden flex items-center justify-center bg-gray-800 bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
        <div class="text-center">
            <i class="text-red-600 w-16 h-16 mb-5" data-feather="x-circle"></i>
            <div class="text-2xl font-semibold mb-4">Are you sure?</div>
            <div class="text-gray-600 mb-5">
                Do you really want to delete this record? This action cannot be undone.
            </div>
            <div class="flex justify-center gap-4">
                <button type="button" class="btn btn-outline-secondary close-modal px-6 py-2 rounded-md text-gray-700 border border-gray-300 hover:bg-gray-100">Cancel</button>
                <button type="button" class="btn btn-danger delete-confirm px-6 py-2 rounded-md text-white bg-red-600 hover:bg-red-700">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- END: Delete Confirmation Modal -->

@endsection

@section('script')
<script>
$(document).ready(function() {
    // Fetch course data based on search and entries per page
    fetchCourseData();

    $('#search').on('keyup', function() {
        fetchCourseData();
    });

    $('#entries-per-page').on('change', function() {
        fetchCourseData();
    });

    function fetchCourseData(page = 1) {
        let search = $('#search').val();
        let entriesPerPage = $('#entries-per-page').val();
        $.ajax({
            url: `{{ url('dashboard/admin/scholarships/index') }}`,
            type: 'GET',
            data: {
                search: search,
                entriesPerPage: entriesPerPage,
                page: page
            },
            success: function(response) {
                // Update table and pagination
                $('#course-data').html(response.data); // Update table data
                $('#pagination').html(response.pagination); // Update pagination
                $('#entries-info').text(`Showing ${response.from || 0} to ${response.to || 0} of ${response.total || 0} entries`); // Show entries info
            }
        });
    }

    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        fetchCourseData(page);
    });

    // Open the delete confirmation modal
    $(document).on('click', '.delete-button', function() {
        var scholarshipId = $(this).data('id');
        $('#delete-confirmation-modal').removeClass('hidden'); // Show the modal
        $('#delete-confirmation-modal .delete-confirm').data('id', scholarshipId); // Store the ID in the confirm delete button
    });

    // Close the modal when the Cancel button is clicked
    $(document).on('click', '.close-modal', function() {
        $('#delete-confirmation-modal').addClass('hidden'); // Hide the modal
    });

    // Confirm delete action
    $(document).on('click', '.delete-confirm', function() {
        var scholarshipId = $(this).data('id');
        var form = $('#delete-form-' + scholarshipId);
        form.submit();  // Submit the delete form for the selected scholarship
        $('#delete-confirmation-modal').addClass('hidden'); // Hide the modal after delete
    });
});


</script>
@endsection
