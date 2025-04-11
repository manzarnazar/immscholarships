@extends('../layout/' . $layout)

@section('subhead')
    <title>Transactions Settings</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
           User's Transactions
        </h2>
    </div>

   <div class="col-span-12 lg:col-span-12 2xl:col-span-12">

</div>  
   <div class="intro-y col-span-12 overflow-auto lg:overflow-visible pt-5">
   
   
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Apply Scholarship ID</th>
                        <th class="whitespace-nowrap">Transaction Refrence</th>
                        <th class="whitespace-nowrap">Name</th>
                        <th class="whitespace-nowrap">Email</th>
                         <th class="whitespace-nowrap">Amount</th>
                        <th class="whitespace-nowrap">Status</th>
                        <th class="whitespace-nowrap">Date</th>
                    
                    </tr>
                </thead>
                <tbody id="course-data">
                    @include('admin.Transactions.partials._table_data', ['paginator' => $transactions])
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
<script>
    function copyToClipboard() {
        const linkInput = document.getElementById('referralLink');
        linkInput.select();
        linkInput.setSelectionRange(0, 99999); 
        document.execCommand('copy');
        alert('Referral link copied to clipboard!');
    }
</script>

@endsection
