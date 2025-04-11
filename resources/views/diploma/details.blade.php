@extends('../layout/' . $layout)

@section('subhead')
    @isset($diplomaEducation)
        <title>Update High School/Diploma - IMS - Scholarship Portal</title>
    @else
        <title>Create High School/Diploma - IMS - Scholarship Portal</title>
    @endisset
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            @isset($diplomaEducation)
                Update Diploma
            @else
                Create Diploma
            @endisset
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-12 2xl:col-span-12">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">High School/Diploma Information</h2>
                </div>
                <div class="p-5">
                    <div class="flex flex-col-reverse xl:flex-row flex-col">
                        <div class="flex-1 mt-6 xl:mt-0">
                            <form id="updateForm" action="@isset($diplomaEducation){{ route('diploma-education-update', $diplomaEducation->id) }}@else{{ route('diploma-education-store') }}@endisset" method="POST" enctype="multipart/form-data">
                                @csrf
                                @isset($diplomaEducation)
                                    @method('PUT')
                                @endisset

                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 2xl:col-span-6">
                                        <div class="mt-3">
                                            <label for="start_date" class="form-label">Starting Date</label>
                                            <input id="start_date" name="start_date" type="date" class="form-control"
                                                placeholder="From" value="@isset($diplomaEducation){{ $diplomaEducation->start_date }}@endisset">
                                        </div>
                                        <div class="mt-3">
                                            <label for="end_date" class="form-label">End Date</label>
                                            <input id="end_date" name="end_date" type="date" class="form-control"
                                                placeholder="End Date" value="@isset($diplomaEducation){{ $diplomaEducation->end_date }}@endisset">
                                        </div>
                                        <div class="mt-3">
                                            <label for="institution_name" class="form-label">Institution Name</label>
                                            <input id="institution_name" name="institution_name" type="text"
                                                class="form-control" placeholder="Institution Name" value="@isset($diplomaEducation){{ $diplomaEducation->institution_name }}@endisset">
                                        </div>
                                    </div>
                                    <div class="col-span-12 2xl:col-span-6 mt-3">
                                        <div>
                                            <label for="country" class="form-label">Country</label>
                                            <?php
                                            use App\Models\Countries as CountryModel;
                                            $countries = CountryModel::orderBy('name')->pluck('name', 'id');
                                            ?>
                                            <select name="country" id="country" class="form-control">
                                                <option value="">Select Country of Origin</option>
                                                @foreach ($countries as $id => $name)
                                                    <option value="{{ $id }}" @isset($diplomaEducation) @if($diplomaEducation->country == $id) selected @endif @endisset>{{ strtoupper($name) }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mt-3">
                                            <label for="major_subject" class="form-label">Major (Course Studied)</label>
                                            <input id="major_subject" name="major_subject" type="text"
                                                class="form-control" placeholder="Major/Course Studied" value="@isset($diplomaEducation){{ $diplomaEducation->major_subject }}@endisset">
                                        </div>

                                        <div class="mt-3">
                                            <label for="award" class="form-label">Award/Certificate</label>
                                            <input id="award" name="award" type="text" class="form-control"
                                                placeholder="Award/Certificate" value="@isset($diplomaEducation){{ $diplomaEducation->award }}@endisset">
                                        </div>
                                    </div>
                                    <div class="col-span-12 2xl:col-span-6 mt-3">
                                        <label for="study_in_china" class="form-label">Have you studied in China? (Please
                                            fill in all study Experience in China)</label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="h_yes"
                                                name="study_in_china" value="YES" @isset($diplomaEducation) @if($diplomaEducation->study_in_china == 'YES') checked @endif @endisset>
                                            <label class="form-check-label" for="h_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="n_no"
                                                name="study_in_china" value="NO" @isset($diplomaEducation) @if($diplomaEducation->study_in_china == 'NO') checked @endif @endisset>
                                            <label class="form-check-label" for="n_no">No</label>
                                        </div>
                                    </div>
                                </div>
                                <input id="imageInput" accept=".jpg, .png" name="image_path" value="@isset($diplomaEducation) {{ $diplomaEducation->image_path }}@endisset" type="file" class="hidden">

                                <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
                            </form>

                        </div>
                        <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                            <div
                            class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <h3>Certificate/Acedemic Transcripts/Letter (JPG,PNG Only)</h3>
                            <br>
                                <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                    <img id="profileImage" class="rounded-md" alt="Bachelor diploma Image"
                                        src="@isset($diplomaEducation) {{ $diplomaEducation->image_path }} @endisset">
                                </div>
                                <div class="mx-auto cursor-pointer relative mt-5">
                                    <button type="button" id="changePhotoButton" class="btn btn-primary w-full mb-2">Change
                                        Photo</button>
                                    @isset($diplomaEducation)
                                        <a href="{{ $diplomaEducation->image_path }}" download="Bachelor diploma Image"
                                            class="btn btn-secondary w-full">Download Photo</a>
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
