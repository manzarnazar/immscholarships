@extends('../layout/' . $layout)

@section('subhead')
    @isset($contactInfoApplicant)
        <title>Update Mailing Address - IMS - Scholarship Portal</title>
    @else
        <title>Create Mailing Address - IMS - Scholarship Portal</title>
    @endisset
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            @isset($contactInfoApplicant)
                Update Mailing Address
            @else
                Create Mailing Address
            @endisset
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-12 2xl:col-span-12">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class=" items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Mailing Address</h2>

                    <h5 class="text-danger">Please make sure the postal address you provided is valid in at least 3 months in order to receive all admission documents successfully.</h5>
                </div>
                <div class="p-5">
                    <div class="flex flex-col-reverse xl:flex-row flex-col">
                        <div class="flex-1 mt-6 xl:mt-0">
                            <form id="updateForm" action="@isset($contactInfoApplicant){{ route('contact-info-applicant-update', $contactInfoApplicant->id) }}@else{{ route('contact-info-applicant-store') }}@endisset" method="POST" enctype="multipart/form-data">
                                @csrf
                                @isset($contactInfoApplicant)
                                    @method('PUT')
                                @endisset
                                <div id="form-container">
                                    <div class="person-form grid grid-cols-12 gap-x-5">
                                        <div class="col-span-12 2xl:col-span-6">
                                            <div class="mt-3">
                                                <label for="mobile" class="form-label">Mobile</label>
                                                <input name="phone" type="tel" class="form-control" placeholder="Mobile" value="@isset($contactInfoApplicant){{ $contactInfoApplicant->phone }}@endisset">
                                            </div>
                                            <div class="mt-3">

                                                <label for="telephone" class="form-label">Home Phone (Telephone)</label>
                                                <input name="telephone" type="text" class="form-control" placeholder="Telephone" value="@isset($contactInfoApplicant){{ $contactInfoApplicant->telephone }}@endisset">
                                            </div>

                                            <div class="mt-3">
                                                <label for="email" class="form-label">Email Address</label>
                                                <input name="email" type="text" class="form-control" placeholder="email" value="@isset($contactInfoApplicant){{ $contactInfoApplicant->email }}@endisset">
                                            </div>
                                        </div>
                                        <div class="col-span-12 2xl:col-span-6 mt-3">
                                            <div class="mt-3">
                                                <label for="address" class="form-label">Physical Address</label>
                                                <input name="physical_address" type="text" class="form-control" placeholder="address" value="@isset($contactInfoApplicant){{ $contactInfoApplicant->physical_address }}@endisset">
                                            </div>
                                            <div class="mt-3">
                                                <label for="postcode" class="form-label">Post Code (Optional)</label>
                                                <input name="postcode" type="text" class="form-control" placeholder="postcode" value="@isset($contactInfoApplicant){{ $contactInfoApplicant->postcode }}@endisset">
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
                            </form>
                        </div>
                        <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                            <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                <div class="mx-auto cursor-pointer relative mt-5">
                                    @isset($contactInfoApplicant)
                                        <button type="button" class="btn btn-secondary w-full" onclick="window.location.href='{{ route('contact-info-applicant') }}'">Back to List</button>
                                    @else
                                        <button type="button" class="btn btn-secondary w-full" onclick="window.location.href='{{ route('contact-info-applicant') }}'">Cancel</button>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Display Information -->
        </div>
    </div>


@endsection
