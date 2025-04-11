@extends('../layout/' . $layout)

@section('subhead')
    <title>Wallet </title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
        Student Wallet
        </h2>
    </div>
   <div class="col-span-12 lg:col-span-12 2xl:col-span-12">
     <div class="col-span-12 mt-8">
                  
                    <div class="grid grid-cols-12 gap-6 mt-5">
                       <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="dollar-sign" class="report-box__icon text-primary"></i>

                                        <div class="ml-auto">
                                          <!--   <div class="report-box__indicator bg-success tooltip cursor-pointer" title="33% Higher than last month">
                                                33% <i data-feather="chevron-up" class="w-4 h-4 ml-0.5"></i>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">${{$wallet->balance ?? '0.00'}} </div>
                                    <div class="text-base text-slate-500 mt-1">Available Balance</div>
                                        @if(isset($wallet->balance) &&  $wallet->balance > 0)
                                      <div class="text-base text-slate-500 mt-1"><a href="{{ route('withdraw.View') }}"  class="btn btn-primary">  Request Withdrawal </a></div>
                                     @endif
                                </div>
                            </div>
                        </div> 
                                            
                              
                    </div>
                </div>

    <!-- end -->
    <!-- END: Display Information -->
</div>  <div class="intro-y flex items-center mt-8">
        <h2>Wallet Transactions</h2>

    </div>

   <div class="intro-y col-span-12 overflow-auto lg:overflow-visible pt-5">
   
   
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Bank Name</th>
                        <th class="whitespace-nowrap">Account No</th> 
                        <th class="whitespace-nowrap">Amount</th> 
                        <th class="whitespace-nowrap">Status</th>
                         <th class="whitespace-nowrap">Date</th>
                    
                    </tr>
                </thead>
                <tbody id="course-data">
                    @include('wallet.partials._table_data', ['paginator' => $withdraw_requests])
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
