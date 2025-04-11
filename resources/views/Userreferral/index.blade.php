@extends('../layout/' . $layout)

@section('subhead')
    <title>Refferal Settings</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Refferal Settings
        </h2>
    </div>

   <div class="col-span-12 lg:col-span-12 2xl:col-span-12">
    <!-- BEGIN: Display Information -->
    @if(auth()->user()->referral_code)
    <div class="intro-y box lg:mt-5">
        <div class="p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h4 class="font-medium text-base mr-auto">Referral Code and link</h4>
            <h1>{{ $user_refferelcode }}</h1>
        </div>
        <div class="p-5">
            <!-- Referral Link -->
            <div class="flex items-center">
                <input 
                    id="referralLink" 
                    type="text" 
                    value="{{ route('register', ['ref' => $user_refferelcode]) }}" 
                    class="form-control w-full lg:w-2/3"
                    readonly
                />
                <button 
                    onclick="copyToClipboard()" 
                    class="btn btn-primary ml-2"
                >
                    Copy
                </button>
            </div>
        </div>
    </div>
    @endif

    <!--blocks  -->
     <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Refferal statistics</h2>
                        
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">


  <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                       <a href="{{ route('admin-scholarships') }}">     
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="credit-card" class="report-box__icon text-pending"></i>
                                        <div class="ml-auto">
                                           <!--  <div class="report-box__indicator bg-danger tooltip cursor-pointer" title="2% Lower than last month">
                                                2% <i data-feather="chevron-down" class="w-4 h-4 ml-0.5"></i>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{ isset($referrals) ? count($referrals) : 0 }}</div>
                                    <div class="text-base text-slate-500 mt-1">Total Refferals</div>
                                </div>
                            </div>
                             </a>
                        </div>

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
                                </div>
                            </div>
                        </div> 
                                            
                              
                    </div>
                </div>
    <!-- end -->
    <!-- END: Display Information -->
</div>  <div class="intro-y flex items-center mt-8">
        <h2>Refferal User List</h2>
    </div>

   <div class="intro-y col-span-12 overflow-auto lg:overflow-visible pt-5">
   
   
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Name</th>
                        <th class="whitespace-nowrap">Email</th>
                         <th class="whitespace-nowrap">commission</th>
                        
                        <th class="whitespace-nowrap">Status</th>
                    
                    </tr>
                </thead>
                <tbody id="course-data">
                    @include('Userreferral.partials._table_data', ['paginator' => $referrals])
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
