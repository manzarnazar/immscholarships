@extends('../layout/' . $layout)

@section('subhead')
    <title>IMS - Role Management</title>
@endsection

@section('subcontent')
<div class="col-12 flex justify-between items-center">
    <h2 class="intro-y text-lg font-medium mt-10">All Roles</h2>
    <div class="flex items-center">
        <a href="{{ route('admin-roles-create') }}" class="btn btn-success">
            <i class="align-middle me-2" data-feather="plus"></i> Add Role
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
                        <th class="whitespace-nowrap">Role Name</th>
                        <th class="whitespace-nowrap">Date Created</th>
                        <th class="text-center whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody id="roles-data">
                    @include('roles.partials._table_data')
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->

        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                <ul class="pagination" id="pagination">
                    @include('layout.components.pagination', ['paginator' => $roles])
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
    fetchRoleData();

    $('#search').on('keyup', function() {
        fetchRoleData();
    });

    $('#entries-per-page').on('change', function() {
        fetchRoleData();
    });

    function fetchRoleData(page = 1) {
        let search = $('#search').val();
        let entriesPerPage = $('#entries-per-page').val();
        $.ajax({
            url: `{{ url('dashboard/admin/roles') }}`,
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
                $('#roles-data').html(response.data); // Update roles table data
                $('#pagination').html(response.pagination); // Update pagination
                $('#entries-info').text(`Showing ${response.from || 0} to ${response.to || 0} of ${response.total || 0} entries`); // Show entries info
            }
        });
    }

    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        fetchRoleData(page);
    });

    // Example delete function (You can implement this)
    function deleteRole(roleId) {
        // Make an AJAX request to delete the role by ID
        if (confirm('Are you sure you want to delete this role?')) {
            $.ajax({
                url: `{{ url('dashboard/admin/roles/delete') }}/${roleId}`,
                type: 'DELETE',
                success: function(response) {
                    fetchRoleData();  // Re-fetch the roles list after deletion
                    alert(response.message);  // Display success message
                }
            });
        }
    }
});
</script>
@endsection
