@extends('../layout/' . $layout)

@section('subhead')
   
        <title>Withdraw - IMS - Scholarship Portal</title>
   
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-12 2xl:col-span-12">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Withdrawal Information</h2>
                </div>
                <div class="p-5">
                    <div class="flex flex-col-reverse xl:flex-row flex-col">
                        <div class="flex-1 mt-6 xl:mt-0">
                            <form id="updateForm" action="{{ route('withdraw.submit') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                               
                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 2xl:col-span-6">
                                        <div class="mt-3">
                                            <label for="update-english-ability-form-1" class="form-label">Name</label>
                                            <input id="update-english-ability-form-1" name="name" type="text" class="form-control" placeholder="Name" required>


                                        </div>

                                        <div class="mt-3">
                                            <label for="update-english-ability-form-2" class="form-label">Bank Name</label>
                                            <input id="update-english-ability-form-2" name="bank_name" type="text" class="form-control" placeholder="Bank Name" required>
                                        </div>

                                      <div class="mt-3">
                                            <label for="update-english-ability-form-2" class="form-label">Bank Account Number</label>
                                            <input id="update-english-ability-form-2" name="acc_no" type="text" class="form-control" placeholder="Account Number" required>
                                        </div>
                                    </div>

                                    <div class="col-span-12 2xl:col-span-6 mt-3">
                                        <div class="mt-3">
                                            <label for="update-english-ability-form-4" class="form-label">Email</label>
                                            <input id="update-english-ability-form-4" name="email" type="text" class="form-control" placeholder="Email" required>
                                        </div>

                                        <div class="mt-3">
                                            <label for="update-english-ability-form-4" class="form-label">Amount</label>
                                            <input id="update-english-ability-form-4" name="amount" type="text" class="form-control" placeholder="Amount" required>
                                        </div>

                                       
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-20 mt-3">Submit Request</button>
                            </form>
                        </div>
                      
                    </div>
                </div>
            </div>
            <!-- END: Display Information -->
        </div>
    </div>
@endsection
