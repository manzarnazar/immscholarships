@extends('../layout/' . $layout)

@section('subhead')
    @isset($passport)
        <title>Update Passport - IMS - Scholarship Portal</title>
    @else
        <title>Create Passport - IMS - Scholarship Portal</title>
    @endisset
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            @isset($passport)
                Update Passport
            @else
                Create Passport
            @endisset
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-12 2xl:col-span-12">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Passport Information</h2>
                </div>
                <div class="p-5">
                    <div class="flex flex-col-reverse xl:flex-row flex-col">
                        <div class="flex-1 mt-6 xl:mt-0">
                            <form id="updateForm" action="@isset($passport){{ route('passports.update', $passport->id) }}@else{{ route('passport-info-store') }}@endisset" method="POST" enctype="multipart/form-data">
                                @csrf
                                @isset($passport)
                                    @method('PUT')
                                @endisset
                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 2xl:col-span-6">
                                        <div class="mt-3">
                                            <label for="update-passport-form-2" class="form-label">Last Name</label>
                                            <input id="update-passport-form-2" name="last_name" type="text" class="form-control" placeholder="Input text" value="@isset($passport) {{ $passport->last_name }} @endisset">
                                        </div>

                                        <div>
                                            <label for="update-passport-form-1" class="form-label">First Name</label>
                                            <input id="update-passport-form-1" name="first_name" type="text" class="form-control" placeholder="Input text" value="@isset($passport) {{ $passport->first_name }} @endisset">
                                        </div>
                                        <div class="mt-3">
                                            <label for="update-passport-form-4" class="form-label">Passport Number</label>
                                            <input id="update-passport-form-4" name="passport_number" type="text" class="form-control" placeholder="Input text" value="@isset($passport) {{ $passport->passport_number }} @endisset">
                                        </div>
                                    </div>
                                    <div class="col-span-12 2xl:col-span-6 mt-3">
                                        <div>
                                            <label for="update-passport-form-5" class="form-label">Issue Date</label>
                                            <input id="update-passport-form-5" name="issued_date" type="date" class="form-control" placeholder="Input text" value="@isset($passport){{ Carbon\Carbon::parse($passport->issued_date)->format('Y-m-d') }}@endisset">
                                        </div>
                                        <div class="mt-3">
                                            <label for="update-passport-form-6" class="form-label">Expiry Date</label>
                                            <input id="update-passport-form-6" name="expiry_date" type="date" class="form-control" placeholder="Input text" value="@isset($passport){{ Carbon\Carbon::parse($passport->expiry_date)->format('Y-m-d') }}@endisset">
                                        </div>


                                    </div>
                                </div>
                                <input id="imageInput" name="image_path" type="file" class="hidden">
                                <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
                            </form>
                        </div>
                        <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                            <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                    <img id="profileImage" class="rounded-md" alt="Passport Image" src="@isset($passport) {{ $passport->image_path }} @endisset">
                                </div>
                                <div class="mx-auto cursor-pointer relative mt-5">
                                    <button type="button" id="changePhotoButton" class="btn btn-primary w-full mb-2">Change Photo</button>
                                    @isset($passport)
                                        <a href="{{ $passport->image_path }}" download="Passport Image" class="btn btn-secondary w-full">Download Photo</a>
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

@section('script')
<script>
    document.getElementById('changePhotoButton').addEventListener('click', function() {
        document.getElementById('imageInput').click();
    });

    document.getElementById('imageInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profileImage').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
