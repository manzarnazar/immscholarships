@extends('../layout/' . $layout)

@section('subhead')
    <title>IMS - Scholarship Portal</title>
@endsection

@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">All {{ strtoupper($type) }} Courses Available</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            {{-- <a href="{{ route('scholarship-create') }}" class="btn btn-primary shadow-md mr-2">Add Course</a> --}}
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
                        <th class="whitespace-nowrap">Course Title</th>
                           <th class="whitespace-nowrap">Country</th>
                              <th class="whitespace-nowrap">City</th>
                        <th class="whitespace-nowrap">Scholarship Code</th>
                        <th class="whitespace-nowrap">Teaching Language</th>
                        <th class="whitespace-nowrap">Status</th>
                        <!-- <th class="whitespace-nowrap">Date Posted</th> -->
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody id="course-data">
                    
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                <ul class="pagination" id="pagination">
                    
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
    <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-feather="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Are you sure?</div>
                        <div class="text-slate-500 mt-2">Do you really want to delete these records? <br>This process cannot be undone.</div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        <button type="button" class="btn btn-danger w-24">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->
@endsection
@section('script')
<script>
    $(document).ready(function() {
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
                url: `{{ url('dashboard/student/scholarships/all/' . $type) }}`,
                type: 'GET',
                data: {
                    search: search,
                    entriesPerPage: entriesPerPage,
                    page: page
                },
                success: function(response) {
                    $('#course-data').html(response.data);
                    $('#pagination').html(response.pagination);
                    $('#entries-info').text(`Showing ${response.from || 0} to ${response.to || 0} of ${response.total || 0} entries`);
                }
            });
        }

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            fetchCourseData(page);
        });
    });
</script>
@endsection
