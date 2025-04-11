@extends('../layout/' . $layout)

@section('subhead')
    @isset($student)
        <title>Update Student - IMS - Scholarship Portal</title>
    @else
        <title>Create Student - IMS - Scholarship Portal</title>
    @endisset
@endsection

@section('subcontent')
<style type="text/css">
    .invalid-feedback {
        color: red;
    }
</style>
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        @isset($student)
            Update Profile
        @else
            Create Profile
        @endisset
    </h2>
</div>
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 lg:col-span-12 2xl:col-span-12">
        <!-- BEGIN: Display Information -->
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">Personal Information</h2>
            </div>
            <div class="p-5">
                <div class="flex flex-col-reverse xl:flex-row flex-col">
                    <div class="flex-1 mt-6 xl:mt-0">
                        <form id="updateForm" action="@isset($student){{ route('students.update', $student->id) }}@else{{ route('basic-info-store') }}@endisset" method="POST" enctype="multipart/form-data">
                            @csrf
                            @isset($student)
                                @method('PUT')
                            @endisset
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 2xl:col-span-6">
                                    <div>
                                        <label for="update-profile-form-1" class="form-label">
                                            First Name <span class="text-red-600">*</span>
                                        </label>
                                        @error('fname')
                                            <div class="invalid-feedback">The First Name field is required.</div>
                                        @enderror
                                        <input id="update-profile-form-1" name="fname" type="text" class="form-control" placeholder="Input text" value="{{ old('fname', isset($student) ? $student->first_name : '') }}" required>
                                    </div>
                                    <div class="mt-3">
                                        <label for="update-profile-form-2" class="form-label">
                                            Last Name <span class="text-red-600">*</span>
                                        </label>
                                        @error('lname')
                                            <div class="invalid-feedback">The Last Name field is required.</div>
                                        @enderror
                                        <input id="update-profile-form-2" name="lname" type="text" class="form-control" placeholder="Input text" value="{{ old('lname', isset($student) ? $student->last_name : '') }}" required>
                                    </div>
                                </div>
                                <div class="col-span-12 2xl:col-span-6 mt-3">
                                    <label for="update-profile-form-4" class="form-label">
                                        Country of Origin <span class="text-red-600">*</span>
                                    </label>
                                    @error('country_origin')
                                        <div class="invalid-feedback">The country origin field is required.</div>
                                    @enderror
                                    <?php
                                        use App\Models\Countries as CountryModel;
                                        $countries = CountryModel::orderBy('name', 'asc')->pluck('name', 'id');
                                    ?>
                                    <select name="country_origin" id="country" class="form-control" required>
                                        <option value="">Select Country of Origin</option>
                                        @foreach ($countries as $id => $name)
                                            <option value="{{ $id }}" @isset($student) @if($student->country_origin == $id) selected @endif @endisset>{{ strtoupper($name) }}</option>
                                        @endforeach
                                    </select>
                                    <div class="mt-3">
                                        <label for="update-profile-form-5" class="form-label">
                                            Date of Birth <span class="text-red-600">*</span>
                                        </label>
                                        @error('dob')
                                            <div class="invalid-feedback">The Date of Birth field is required.</div>
                                        @enderror
                                        <input id="update-profile-form-5" name="dob" type="date" class="form-control" placeholder="Input text" value="@isset($student){{ Carbon\Carbon::parse($student->dob)->format('Y-m-d') }}@endisset" required>
                                    </div>
                                </div>
                                <div class="col-span-12 2xl:col-span-6">
                                    <div>
                                        <label for="update-profile-form-3" class="form-label">
                                            Middle Name <span class="text-red-600">*</span>
                                        </label>
                                        @error('mname')
                                            <div class="invalid-feedback">The Middle Name field is required.</div>
                                        @enderror
                                        <input id="update-profile-form-3" name="mname" type="text" class="form-control" placeholder="Input text" value="{{ old('mname', isset($student) ? $student->middle_name : '') }}" required>
                                    </div>
                                    <div class="mt-3 2xl:mt-3">
                                        <label for="update-profile-form-4" class="form-label">
                                            Gender <span class="text-red-600">*</span>
                                        </label>
                                        @error('gender')
                                            <div class="invalid-feedback">The gender field is required.</div>
                                        @enderror
                                        <input id="update-profile-form-4" name="gender" type="text" class="form-control" placeholder="Input text" value="{{ old('gender', isset($student) ? $student->gender : '') }}" required>
                                    </div>
                                    <div class="mt-3">
                                        <label for="update-profile-form-12" class="form-label">
                                            Country Of Birth <span class="text-red-600">*</span>
                                        </label>
                                        @error('country_of_birth')
                                            <div class="invalid-feedback">The country of birth field is required.</div>
                                        @enderror
                                        <input id="update-profile-form-12" name="country_of_birth" type="text" class="form-control" placeholder="Input text" value="{{ old('country_of_birth', isset($student) ? $student->country_of_birth : '') }}" required>
                                    </div>
                                    <div class="mt-3">
                                        <label for="update-profile-form-13" class="form-label">
                                            Place of Birth <span class="text-red-600">*</span>
                                        </label>
                                        @error('place_of_birth')
                                            <div class="invalid-feedback">The place of birth field is required.</div>
                                        @enderror
                                        <input id="update-profile-form-13" name="place_of_birth" type="text" class="form-control" placeholder="Input text" value="{{ old('place_of_birth', isset($student) ? $student->place_of_birth : '') }}" required>
                                    </div>
                                </div>
                                <div class="col-span-12 xl:col-span-6">
                                    <div>
                                        <label for="update-profile-form-6" class="form-label">
                                            Chinese Name
                                        </label>
                                        <input id="update-profile-form-6" name="chinese_name" type="text" class="form-control" placeholder="Input text" value="{{ old('chinese_name', isset($student) ? $student->chinese_name : '') }}">
                                    </div>
                                    <div class="mt-3">
                                        <label for="update-profile-form-7" class="form-label">
                                            Highest Education <span class="text-red-600">*</span>
                                        </label>
                                        @error('highest_education')
                                            <div class="invalid-feedback">The highest education field is required.</div>
                                        @enderror
                                        <input id="update-profile-form-7" name="highest_education" type="text" class="form-control" placeholder="Input text" value="{{ old('highest_education', isset($student) ? $student->highest_education : '') }}" required>
                                    </div>
                                    <div class="mt-3">
                                        <label for="update-profile-form-8" class="form-label">
                                            Native Language <span class="text-red-600">*</span>
                                        </label>
                                        @error('native_language')
                                            <div class="invalid-feedback">The Native language field is required.</div>
                                        @enderror
                                        <input id="update-profile-form-8" name="native_language" type="text" class="form-control" placeholder="Input text" value="{{ old('native_language', isset($student) ? $student->native_language : '') }}" required>
                                    </div>
                                    <div class="mt-3">
                                        <label for="religion-select" class="form-label">
                                            Religion <span class="text-red-600">*</span>
                                        </label>
                                        @error('religion')
                                            <div class="invalid-feedback">The religion field is required.</div>
                                        @enderror
                                        <select name="religion" id="religion-select" class="form-control" required>
                                            <option value="">Select Religion</option>
                                            <option value="Islam" @isset($student) @if($student->religion == 'Islam') selected @endif @endisset>Islam</option>
                                            <option value="Christianity" @isset($student) @if($student->religion == 'Christianity') selected @endif @endisset>Christianity</option>
                                            <option value="Hinduism" @isset($student) @if($student->religion == 'Hinduism') selected @endif @endisset>Hinduism</option>
                                            <option value="Other" @isset($student) @if($student->religion && !in_array($student->religion, ['Christianity', 'Islam', 'Hinduism'])) selected @endif @endisset>Other (please specify)</option>
                                        </select>
                                        <input id="religion-other" name="religion_other" type="text" class="form-control mt-3" placeholder="Specify Religion" style="display: none;" value="@isset($student) @if(!in_array($student->religion, ['Christianity', 'Islam', 'Hinduism'])) {{ $student->religion }} @endif @endisset">
                                    </div>
                                </div>
                                <div class="col-span-12 xl:col-span-6">
                                    <div class="mt-3 xl:mt-0">
                                        <label for="update-profile-form-10" class="form-label">
                                            Marital Status <span class="text-red-600">*</span>
                                        </label>
                                        @error('marital_status')
                                            <div class="invalid-feedback">The marital status field is required.</div>
                                        @enderror
                                        <select name="marital_status" id="marital-status" class="form-control" required>
                                            <option value="">Select Marital Status</option>
                                            <option value="Single" @isset($student) @if($student->marital_status == 'Single') selected @endif @endisset>Single</option>
                                            <option value="Married" @isset($student) @if($student->marital_status == 'Married') selected @endif @endisset>Married</option>
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <label for="update-profile-form-11" class="form-label">
                                            Profession
                                        </label>
                                        <input id="update-profile-form-11" name="profession" type="text" class="form-control" placeholder="Input text" value="{{ old('profession', isset($student) ? $student->profession : '') }}">
                                    </div>
                                    <div class="mt-3">
                                        <label for="update-profile-form-12" class="form-label">
                                            Hobby
                                        </label>
                                        <input id="update-profile-form-12" name="hobby" type="text" class="form-control" placeholder="Input text" value="{{ old('hobby', isset($student) ? $student->hobby : '') }}">
                                    </div>
                                    <div class="mt-3">
                                        <label for="update-profile-form-13" class="form-label">
                                            Health Status <span class="text-red-600">*</span>
                                        </label>
                                        @error('health_status')
                                            <div class="invalid-feedback">The health status field is required.</div>
                                        @enderror
                                        <select name="health_status" id="health-status" class="form-control" required>
                                            <option value="">Select Your Health Status</option>
                                            <option value="Very Healthy" @isset($student) @if($student->health_status == 'Very Healthy') selected @endif @endisset>
                                                Very Healthy
                                            </option>
                                            <option value="Healthy" @isset($student) @if($student->health_status == 'Healthy') selected @endif @endisset>
                                                Healthy
                                            </option>
                                            <option value="Average" @isset($student) @if($student->health_status == 'Average') selected @endif @endisset>
                                                Average
                                            </option>
                                            <option value="Unhealthy" @isset($student) @if($student->health_status == 'Unhealthy') selected @endif @endisset>
                                                Unhealthy
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-span-12 xl:col-span-6">
                                    <div class="mt-3 xl:mt-0">
                                        <label for="update-profile-form-10" class="form-label">
                                            Mobile Number (With Country Code ex: +86212321421) <span class="text-red-600">*</span>
                                        </label>
                                        @error('mobile')
                                            <div class="invalid-feedback">The mobile field is required.</div>
                                        @enderror
                                        <input id="update-profile-form-10" name="mobile" type="text" class="form-control" placeholder="ex:+86212321421" value="{{ old('mobile', isset($student) ? $student->mobile : '') }}" required>
                                    </div>
                                    <div class="mt-3">
                                        <label for="update-profile-form-11" class="form-label">
                                            Current Address <span class="text-red-600">*</span>
                                        </label>
                                        @error('current_address')
                                            <div class="invalid-feedback">The current address field is required.</div>
                                        @enderror
                                        <input id="update-profile-form-11" name="current_address" type="text" class="form-control" placeholder="Input text" value="{{ old('current_address', isset($student) ? $student->current_address : '') }}" required>
                                    </div>
                                    <div class="mt-3">
                                        <label for="update-profile-form-12" class="form-label">
                                            Current City <span class="text-red-600">*</span>
                                        </label>
                                        @error('current_city')
                                            <div class="invalid-feedback">The current city field is required.</div>
                                        @enderror
                                        <input id="update-profile-form-12" name="current_city" type="text" class="form-control" placeholder="Input text" value="{{ old('current_city', isset($student) ? $student->current_city : '') }}" required>
                                    </div>
                                    <div class="mt-3">
                                        <label for="update-profile-form-13" class="form-label">
                                            Current Location <span class="text-red-600">*</span>
                                        </label>
                                        @error('available_in_china')
                                            <div class="invalid-feedback">The Current Location field is required.</div>
                                        @enderror
                                        <input id="update-profile-form-13" name="available_in_china" type="text" class="form-control" placeholder="Input text" value="{{ old('available_in_china', isset($student) ? $student->available_in_china : '') }}" required>
                                    </div>
                                </div>
                            </div>
                            <!-- Only require file input when creating a new profile -->
                            <input id="imageInput" name="image_path" type="file" class="hidden" @if(!isset($student)) required @endif>
                            <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
                        </form>
                    </div>
                    <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                        @error('image_path')
                            <div class="invalid-feedback">Image Field is Required</div>
                        @enderror
                        <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <span class="text-primary">
                                Upload your high quality profile picture with a white background <span class="text-red-600">*</span>
                            </span>
                            <br><br>
                            <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                <img id="profileImage" class="rounded-md" alt="Profile Image" src="@isset($student){{ $student->image_path }}@endisset">
                            </div>
                            <div class="mx-auto cursor-pointer relative mt-5">
                                <button type="button" id="changePhotoButton" class="btn btn-primary w-full">Change Photo</button>
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

    document.getElementById('religion-select').addEventListener('change', function() {
        const otherInput = document.getElementById('religion-other');
        if (this.value === 'Other') {
            otherInput.style.display = 'block';
        } else {
            otherInput.style.display = 'none';
            otherInput.value = ''; // Clear the other input if it's hidden
        }
    });

    // Initial check if 'Other' was selected during page load
    window.onload = function() {
        const religionSelect = document.getElementById('religion-select');
        const otherInput = document.getElementById('religion-other');
        if (religionSelect.value === 'Other') {
            otherInput.style.display = 'block';
        } else {
            otherInput.style.display = 'none';
        }
    };
</script>
@endsection
