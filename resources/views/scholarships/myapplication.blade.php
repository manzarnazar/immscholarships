@extends('../layout/' . $layout)

@section('subhead')
   
        <title>My application- IMS - Scholarship Portal</title>
  
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
               My application
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-12 2xl:col-span-12">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">My application Information</h2>
                </div>
                <div class="p-5">
                    <div class="flex flex-col-reverse xl:flex-row flex-col">
                        <div class="flex-1 mt-6 xl:mt-0">
                             <div class="p-5">
                    <h5 class="text-sm text-gray-500">Contact Details</h5>
                    <p>Application ID: <strong>{{ $applyScholarships->application_id }}</strong></p>
                </div>

                  <div class="p-5">
                  
                    <p>Payment status: <strong>{{ $applyScholarships->payment_status }}</strong></p>
                </div>

                  <div class="p-5">
                    
                    <p>Status: <strong>
                                @if ($applyScholarships->status == 'pending')
                                    <span class="badge bg-warning"> {{ strtoupper($applyScholarships->status) }}</span>
                                @elseif($applyScholarships->status == 'approved')
                                    <span class="badge bg-primary text-white"> {{ strtoupper($applyScholarships->status) }}</span>
                                @elseif($applyScholarships->status == 'rejected')
                                    <span class="badge bg-danger"> {{ strtoupper($applyScholarships->status) }}</span>
                                    <p>Reject Reason</p>
                                      <span class="badge bg-danger"> {{ strtoupper($applyScholarships->rejection_reason) }}</span>
                                @else
                                    <span class="badge bg-danger">No status application</span>
                                @endif
                            </td></strong></p>
                </div>


                  <div class="p-5">
                    
                    <p>Email Address: <strong>{{ Auth::user()->email }}</strong></p>
                </div>


                <div class="p-5">
                     @if($applyScholarships->status == 'rejected')
                   <a href="{{ route('scholarship-Reapply', ['id' => $applyScholarships->id]) }}" class="btn btn-danger">
                                <i class="fa fa-close"></i> Re Apply
                            </a>

                    @endif
                </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- END: Display Information -->
        </div>
    </div>
@endsection
