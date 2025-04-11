@extends('../layout/' . $layout)

@section('subhead')
    <title>IMS - Staff Management</title>
@endsection

@section('subcontent')
<div class="col-12 flex justify-between items-center">
    <h2 class="intro-y text-lg font-medium mt-10">All Registered Staff</h2>
    <div class="flex items-center">
        <a href="{{ route('admin-users-management-create') }}" class="btn btn-success">
            <i class="align-middle me-2" data-feather="plus"></i> Add Staff
        </a>
    </div>
</div>

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
                        <th class="whitespace-nowrap">Full Name</th>
                        <th class="whitespace-nowrap">Email Address</th>
                        <th class="whitespace-nowrap">Role</th>
                        <th class="whitespace-nowrap">Date Created</th>
                        <th class="text-center whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody id="staff-data">
                   @include('users-management.partials._table_data')
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->

        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                <ul class="pagination" id="pagination">
                    @include('layout.components.pagination', ['paginator' => $staff])
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
@endsection

@section('script')
<script>
$(document).ready(function() {
    fetchStaffData();

    $('#search').on('keyup', function() {
        fetchStaffData();
    });

    $('#entries-per-page').on('change', function() {
        fetchStaffData();
    });

    function fetchStaffData(page = 1) {
        let search = $('#search').val();
        let entriesPerPage = $('#entries-per-page').val();
        $.ajax({
            url: `{{ url('dashboard/admin/users/management') }}`,
            type: 'GET',
            data: {
                search: search,
                entriesPerPage: entriesPerPage,
                page: page
            },
            success: function(response) {
                // Log the response to verify it contains the correct data
                console.log(response);

                // Update table and pagination
                $('#staff-data').html(response.data); // Update staff table data
                $('#pagination').html(response.pagination); // Update pagination
                $('#entries-info').text(`Showing ${response.from || 0} to ${response.to || 0} of ${response.total || 0} entries`);

            }
        });
    }

    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        fetchStaffData(page);
    });

    // Example delete function (You can implement this)
    function deleteStaff(staffId) {
        // Make an AJAX request to delete the staff by ID
        if (confirm('Are you sure you want to delete this staff member?')) {
            $.ajax({
                url: `{{ url('dashboard/admin/staff-management/delete') }}/${staffId}`,
                type: 'DELETE',
                success: function(response) {
                    fetchStaffData();  // Re-fetch the staff list after deletion
                    alert(response.message);  // Display success message
                }
            });
        }
    }
});
</script>
@endsection
