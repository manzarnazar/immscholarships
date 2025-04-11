@extends('../layout/' . $layout)

@section('subhead')
    <title>IMS - Student Portal</title>
@endsection
<style type="text/css">
    .pagination {
        flex-wrap: wrap; /* Allow pagination to break into multiple lines */
        overflow-x: auto; /* Prevent it from breaking out of the container */
        white-space: nowrap; /* Keep items in a single row */
    }

    /* Enhance Table Headers with Darker Green */
    .table th {
        font-weight: 700; /* Bold text */
        background: linear-gradient(45deg, #2e7d32, #388e3c); /* Darker green gradient */
        color: #fff;
        padding: 12px 15px;
        text-align: left;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-bottom: 2px solid #ddd;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .table th:hover {
        background: linear-gradient(45deg, #43a047, #388e3c); /* Lighter green on hover */
        transform: scale(1.05); /* Slight zoom effect */
    }

    /* Make WhatsApp Numbers Stand Out */
    .whatsapp {
        font-weight: 600;
        color: #ffbf47; /* Yellowish orange */
        background-color: #2a2e33;
        padding: 2px 8px;
        border-radius: 4px;
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
        display: inline-flex;
        align-items: center;
        transition: color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
        text-decoration: none;
    }

    .whatsapp:hover {
        color: #fff;
        background-color: #ff914d; /* Lighter orange on hover */
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
        transform: scale(1.05); /* Zoom effect on hover */
    }

    /* WhatsApp Icon Style */
    .whatsapp i {
        font-size: 16px;
        margin-right: 6px;
    }

    /* Tooltip Styles */
    .whatsapp:hover .tooltip-text {
        visibility: visible;
        opacity: 1;
    }

    .tooltip-text {
        visibility: hidden;
        opacity: 0;
        background-color: #333;
        color: #fff;
        text-align: center;
        border-radius: 5px;
        padding: 5px;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 50%;
        margin-left: -60px;
        width: 120px;
        transition: opacity 0.3s;
    }

    .tooltip-text::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #333 transparent transparent transparent;
    }
</style>

@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">All Registered Students</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <div class="hidden md:block mx-auto text-slate-500" id="entries-info"></div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <input type="text" id="search" class="form-control w-56 box pr-10" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Student Name</th>
                        <th class="whitespace-nowrap">Email Address</th>
                        <th class="whitespace-nowrap">Student WhatsApp Number</th>
                        <th class="whitespace-nowrap">Country</th>
                        <th class="whitespace-nowrap">Education Level</th>
                        <th class="text-center whitespace-nowrap">ACTION</th>
                    </tr>
                </thead>
                <tbody id="student-data">
                    @include('students.partials._table_data')
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->

        <div class="intro-y col-span-12 flex flex-wrap items-center justify-between">
            <nav class="w-full sm:w-auto overflow-x-auto">
                <ul class="pagination" id="pagination">
                    @include('layout.components.pagination', ['paginator' => $students])
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
                    Do you really want to delete this student record? This action cannot be undone.
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
    fetchStudentData();

    $('#search').on('keyup', function() {
        fetchStudentData();
    });

    $('#entries-per-page').on('change', function() {
        fetchStudentData();
    });

    function fetchStudentData(page = 1) {
        let search = $('#search').val();
        let entriesPerPage = $('#entries-per-page').val();
        $.ajax({
            url: `{{ url('dashboard/admin/students/list') }}`,
            type: 'GET',
            data: {
                search: search,
                entriesPerPage: entriesPerPage,
                page: page
            },
            success: function(response) {
                // Update table and pagination
                $('#student-data').html(response.data); // Update table data
                $('#pagination').html(response.pagination); // Update pagination
                $('#entries-info').text(`Showing ${response.from || 0} to ${response.to || 0} of ${response.total || 0} entries`); // Show entries info
            }
        });
    }

    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        fetchStudentData(page);
    });

    // Open the delete confirmation modal
    $(document).on('click', '.delete-button', function() {
        var studentId = $(this).data('id');
        $('#delete-confirmation-modal').removeClass('hidden'); // Show the modal
        $('#delete-confirmation-modal .delete-confirm').data('id', studentId); // Store the ID in the confirm delete button
    });

    // Close the modal when the Cancel button is clicked
    $(document).on('click', '.close-modal', function() {
        $('#delete-confirmation-modal').addClass('hidden'); // Hide the modal
    });

    // Confirm delete action
    $(document).on('click', '.delete-confirm', function() {
        var studentId = $(this).data('id');
        var form = $('#delete-form-' + studentId);
       
        form.submit();  // Submit the delete form for the selected student
        $('#delete-confirmation-modal').addClass('hidden'); // Hide the modal after delete
    });
});
</script>
@endsection


