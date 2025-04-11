@extends('../layout/' . $layout)

@section('subhead')
    <title>Refferal Commission Amount - Admin Panel</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Set Refferal Commission Amount
        </h2>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-12 2xl:col-span-12">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Amount</h2>
                </div>
                <div class="p-5">
                    <form id="roleForm" method="POST" action="{{ route('admin-refferalamount-update') }}">
                        @csrf

                        <!-- Role Name Input -->
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 2xl:col-span-6">
                                <div class="mt-3">
                                    <label for="name" class="form-label">Set Amount ($-USD)</label>
                                    <input id="name" name="referral_amount" type="text" class="form-control" placeholder="Amount" value="{{$referral_amount->value}}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end mt-4">
                            <button type="submit" class="btn btn-primary w-20">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Display Information -->

               <div class="col-span-12 lg:col-span-12 2xl:col-span-12">
     <div class="col-span-12 mt-8">
                  
                    <div class="grid grid-cols-12 gap-6 mt-5">
                       <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="credit-card" class="report-box__icon text-primary"></i>

                                        <div class="ml-auto">
                                        
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{$totalReferrals ?? '0.00'}} </div>
                                    <div class="text-base text-slate-500 mt-1">Total Reffered User</div>
                                       
                                </div>
                            </div>
                        </div> 
                                            
                              
                    </div>
                </div>

    <!-- end -->
    <!-- END: Display Information -->
</div>
        </div>
    </div>

    <div class="intro-y flex items-center mt-8">
        <h2>Reffered User List</h2>

    </div>

   <div class="intro-y col-span-12 overflow-auto lg:overflow-visible pt-5">
   
   
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                         <th>Referrer Name</th>
            <th>Referrer Email</th>
            <th>Referred Name</th>
            <th>Referred Email</th>
            <th>Referral Date</th>
                    
                    </tr>
                </thead>
                <tbody id="course-data">
                    @include('referral.partials._table_data', ['paginator' => $referrals])
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
@endsection
