@extends('../layout/' . $layout)

@section('subhead')
    <title>IMS - Scholarship Portal</title>
@endsection

@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">All Attachments List</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('attachments-create') }}" class="btn btn-primary shadow-md mr-2">Add Info</a>
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
                        <th class="whitespace-nowrap">#</th>
                        <th class="whitespace-nowrap">Study Plan</th>
                        <th class="whitespace-nowrap">CV</th>
                        <th class="whitespace-nowrap">Bank Statement</th>
                        <th class="whitespace-nowrap">Recommendation Letter</th>
                        <th class="whitespace-nowrap">Police Clearance</th>
                        <!-- <th class="whitespace-nowrap">Physical Exam</th> -->
                        <th class="whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody id="attachments-data">
                    @include('attachments.attachments-data', ['attachments' => $attachments])
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                <ul class="pagination" id="pagination">
                    @include('layout.components.pagination', ['paginator' => $attachments])
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
            fetchAttachmentsData();

            $('#search').on('keyup', function() {
                fetchAttachmentsData();
            });

            $('#entries-per-page').on('change', function() {
                fetchAttachmentsData();
            });

            function fetchAttachmentsData(page = 1) {
                let search = $('#search').val();
                let entriesPerPage = $('#entries-per-page').val();
                $.ajax({
                    url: '{{ route("ajax.attachments") }}',
                    type: 'GET',
                    data: {
                        search: search,
                        entriesPerPage: entriesPerPage,
                        page: page
                    },
                    success: function(response) {
                        $('#attachments-data').html(response.data);
                        $('#pagination').html(response.pagination);
                        $('#entries-info').text(`Showing ${response.from || 0} to ${response.to || 0} of ${response.total || 0} entries`);
                    }
                });
            }

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                fetchAttachmentsData(page);
            });


        });


    </script>
@endsection
