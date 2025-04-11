@extends('../layout/' . $layout)

@section('subhead')
    @isset($institution)
        <title>Update Institution - IMS - Scholarship Portal</title>
    @else
        <title>Create Institution - IMS - Scholarship Portal</title>
    @endisset
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            @isset($institution)
                Update Institution
            @else
                Create Institution
            @endisset
        </h2>
    </div>
    <style type="text/css">
        .ck-content ol{
            padding: 20px !important;
        }
    </style>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-12 2xl:col-span-12">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Institution Information</h2>
                </div>

                <div class="p-5">
                    <div class="flex flex-col-reverse xl:flex-row flex-col">
                        <div class="flex-1 mt-6 xl:mt-0">
                            <form id="institutionForm" method="POST"
                                action="@isset($institution){{ route('admin-institutions-update', $institution->id) }}@else{{ route('admin-institutions-store') }}@endisset">
                                @csrf
                                @isset($institution)
                                    @method('PUT')
                                @endisset

                                <div class="grid grid-cols-12 gap-x-5">
                                    <!-- University Name -->
                                    <div class="col-span-12 2xl:col-span-6">
                                        <div class="mt-3">
                                            <label for="name" class="form-label">University Name</label>
                                            <input id="name" name="name" type="text" class="form-control"
                                                placeholder="University Name"
                                                value="{{ old('name', $institution->name ?? '') }}">
                                        </div>
                                    </div>

                                    <!-- Country -->
                                    <div class="col-span-12 2xl:col-span-6 mt-3">
                                        <div>
                                            <label for="country" class="form-label">Country</label>
                                            <?php
                                            use App\Models\Countries as CountryModel;
                                            $countries = CountryModel::pluck('name', 'id');
                                            ?>
                                            <select name="country" id="country" class="form-control">
                                                <option value="">Select Country</option>
                                                @foreach ($countries as $id => $name)
                                                    <option value="{{ $id }}"
                                                        @isset($institution) @if ($institution->country == $id) selected @endif @endisset>
                                                        {{ strtoupper($name) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Province -->
                                    <div class="col-span-12 2xl:col-span-6 mt-3">
                                        <div>
                                            <label for="province" class="form-label">Province</label>
                                            <input id="province" name="province" type="text" class="form-control"
                                                placeholder="Province"
                                                value="{{ old('province', $institution->province ?? '') }}">
                                        </div>
                                    </div>

                                    <!-- City -->
                                    <div class="col-span-12 2xl:col-span-6 mt-3">
                                        <div>
                                            <label for="city" class="form-label">City</label>
                                            <input id="city" name="city" type="text" class="form-control"
                                                placeholder="City Name"
                                                value="{{ old('city', $institution->city ?? '') }}">
                                        </div>
                                    </div>

                                    <!-- Education Level -->
                                    <div class="col-span-12 2xl:col-span-6 mt-3">
                                        <div>
                                            <label for="education_level" class="form-label">Education Level</label>
                                            <select name="education_level" id="education_level" class="form-control">
                                                <option value="">Select Education Level</option>
                                                <option value="masters"
                                                    @isset($institution) @if ($institution->education_level == 'masters') selected @endif @endisset>
                                                    Masters Degree</option>
                                                <option value="bachelor"
                                                    @isset($institution) @if ($institution->education_level == 'bachelor') selected @endif @endisset>
                                                    Bachelor Degree</option>

                                                    <option value="PHD"
                                                    @isset($institution) @if ($institution->education_level == 'PHD') selected @endif @endisset>
                                                    PHD Degree</option>
                                                <option value="language program"
                                                    @isset($institution) @if ($institution->education_level == 'language program') selected @endif @endisset>
                                                    Language Program</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Duration -->
                                    <div class="col-span-12 2xl:col-span-6 mt-3">
                                        <div>
                                            <label for="duration" class="form-label">Duration</label>
                                            <input id="duration" name="duration" type="text" class="form-control"
                                                placeholder="Duration (e.g., 4 years)"
                                                value="{{ old('duration', $institution->duration ?? '') }}">
                                        </div>
                                    </div>

                                    <!-- Application Timeline -->
                                    <div class="col-span-12 2xl:col-span-6 mt-3">
                                        <div>
                                            <label for="timeline" class="form-label">Application Timeline</label>
                                            <textarea id="timeline" name="timeline" class="form-control" placeholder="Application Timeline">
                                                {{ old('timeline', $institution->timeline ?? '') }}
                                            </textarea>
                                        </div>
                                    </div>

                                    <!-- Fees -->
                                    <div class="col-span-12 2xl:col-span-6 mt-3">
                                        <div>
                                            <label for="application_fee" class="form-label">University Fees</label>
                                            <textarea id="application_fee" name="application_fee" class="form-control" placeholder="Fees details">
                                                {{ old('application_fee', $institution->application_fee ?? '') }}
                                            </textarea>
                                        </div>
                                    </div>

                                    <!-- IMS Service Fee -->
                                    <div class="col-span-12 2xl:col-span-6 mt-3">
                                        <div>
                                            <label for="ims_fee" class="form-label">IMS Application Fee</label>
                                            <textarea id="ims_fee" name="ims_fee" class="form-control" placeholder="IMS Service Fees">
                                                {{ old('ims_fee', $institution->ims_fee ?? '') }}
                                            </textarea>
                                        </div>
                                    </div>

                                    <!-- Scholarships -->
                                    <div class="col-span-12 2xl:col-span-6 mt-3">
                                        <div>
                                            <label for="scholarship" class="form-label">Scholarships</label>
                                            <textarea id="scholarship" name="scholarship" class="form-control" placeholder="Scholarship details">
                                                {{ old('scholarship', $institution->scholarship ?? '') }}
                                            </textarea>
                                        </div>
                                    </div>

                                    <!-- Admission Requirements -->
                                    <div class="col-span-12 mt-3">
                                        <div>
                                            <label for="requirements" class="form-label">Admission Requirements</label>
                                            <textarea id="requirements" name="requirements" class="form-control" placeholder="Admission Requirements">
                                                {{ old('requirements', $institution->requirements ?? '') }}
                                            </textarea>
                                        </div>
                                    </div>

                                </div>

                                <button type="submit" id="btn" class="btn btn-primary w-20 mt-3">Save</button>
                            </form>
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
        $(document).ready(function() {

            ClassicEditor
                .create(document.querySelector('#timeline'))
                .catch(error => {
                    console.error(error);
                });

            ClassicEditor
                .create(document.querySelector('#application_fee'))
                .catch(error => {
                    console.error(error);
                });

            ClassicEditor
                .create(document.querySelector('#ims_fee'))
                .catch(error => {
                    console.error(error);
                });

            ClassicEditor
                .create(document.querySelector('#scholarship'))
                .catch(error => {
                    console.error(error);
                });

            ClassicEditor
                .create(document.querySelector('#requirements'))
                .catch(error => {
                    console.error(error);
                });


                $('#btn').click(function() {
                // e.preventDefault();
                dataValidation();
            });

        });
</script>
        @endsection
