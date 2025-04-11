@extends('../layout/' . $layout)

@section('subhead')
    @isset($financialSupporter)
        <title>Update Family Members Info - IMS - Scholarship Portal</title>
    @else
        <title>Create Family Members Info - IMS - Scholarship Portal</title>
    @endisset
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            @isset($financialSupporter)
                Update Family Members Information
            @else
                Create Family Members Information
            @endisset
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-12 2xl:col-span-12">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Family Members - Please input at least two family members information</h2>
                </div>
                <div class="p-5">
                    <div class="flex flex-col-reverse xl:flex-row flex-col">
                        <div class="flex-1 mt-6 xl:mt-0">
                            <form id="updateForm" action="@isset($financialSupporter){{ route('financial-supporter-update', $financialSupporter->id) }}@else{{ route('financial-supporter-store') }}@endisset" method="POST" enctype="multipart/form-data">
                                @csrf
                                @isset($financialSupporter)
                                    @method('PUT')
                                @endisset
                                <div id="form-container">
                                    <div class="person-form grid grid-cols-12 gap-x-5 mb-6">
                                        <!-- Original form fields -->
                                        <div class="col-span-12 2xl:col-span-6">
                                            <div class="mt-3">
                                                <label for="name0" class="form-label">Full Name</label>
                                                <input id="name0" name="name[]" type="text" class="form-control" placeholder="Full Name" value="{{ old('name.0') }}">
                                            </div>
                                            <div class="mt-3">
                                                <label for="relationship0" class="form-label">Relationship</label>
                                                <select id="relationship0" class="form-control" name="relationship[]">
                                                    <option value="">Select Relationship</option>
                                                    <option value="Mother" {{ old('relationship.0') == 'Mother' ? 'selected' : '' }}>Mother</option>
                                                    <option value="Father" {{ old('relationship.0') == 'Father' ? 'selected' : '' }}>Father</option>
                                                    <option value="Sister" {{ old('relationship.0') == 'Sister' ? 'selected' : '' }}>Sister</option>
                                                    <option value="Brother" {{ old('relationship.0') == 'Brother' ? 'selected' : '' }}>Brother</option>
                                                    <option value="Uncle" {{ old('relationship.0') == 'Uncle' ? 'selected' : '' }}>Uncle</option>
                                                    <option value="Aunt" {{ old('relationship.0') == 'Aunt' ? 'selected' : '' }}>Aunt</option>
                                                    <option value="Grandmom" {{ old('relationship.0') == 'Grandmom' ? 'selected' : '' }}>Grandmom</option>
                                                    <option value="Grandpa" {{ old('relationship.0') == 'Grandpa' ? 'selected' : '' }}>Grandpa</option>
                                                </select>
                                            </div>
                                            <div class="mt-3">
                                                <label for="email0" class="form-label">Email Address</label>
                                                <input id="email0" name="email[]" type="text" class="form-control" placeholder="Email" value="{{ old('email.0') }}">
                                            </div>
                                            <div class="mt-3">
                                                <label for="address0" class="form-label">Physical Address</label>
                                                <input id="address0" name="address[]" type="text" class="form-control" placeholder="Address" value="{{ old('address.0') }}">
                                            </div>
                                        </div>
                                        <div class="col-span-12 2xl:col-span-6 mt-3">
                                            <div class="mt-3">
                                                <label for="profession0" class="form-label">Profession</label>
                                                <input id="profession0" name="profession[]" type="text" class="form-control" placeholder="Profession" value="{{ old('profession.0') }}">
                                            </div>
                                            <div class="mt-3">
                                                <label for="work_institution0" class="form-label">Work Institution</label>
                                                <input id="work_institution0" name="work_institution[]" type="text" class="form-control" placeholder="Work Institution" value="{{ old('work_institution.0') }}">
                                            </div>
                                            <div class="mt-3">
                                                <label for="country0" class="form-label">Country</label>
                                                <?php
                                                use App\Models\Countries as CountryModel;
                                                $countries = CountryModel::orderBy('name', 'asc')->pluck('name', 'id');
                                                ?>
                                                <select id="country0" name="country[]" class="form-control">
                                                    <option value="">Select Country of Origin</option>
                                                    @foreach ($countries as $id => $name)
                                                        <option value="{{ $id }}" {{ old('country.0') == $id ? 'selected' : '' }}>{{ strtoupper($name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mt-3">
                                                <label for="mobile0" class="form-label">Mobile</label>
                                                <input id="mobile0" name="mobile[]" type="text" class="form-control" placeholder="Mobile" value="{{ old('mobile.0') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" id="duplicate-btn" class="btn btn-secondary w-20 mt-3">Add Another</button>
                                <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
                            </form>
                        </div>
                        @isset($financialSupporter)
                        <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                            <div class="mx-auto cursor-pointer relative mt-5">
                                <button type="button" class="btn btn-secondary w-full" onclick="window.location.href='{{ route('financial-supporter') }}'">Back to List</button>
                            </div>
                        </div>
                        @endisset
                    </div>
                </div>
            </div>
            <!-- END: Display Information -->
        </div>
    </div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const duplicateBtn = document.getElementById('duplicate-btn');
        const formContainer = document.getElementById('form-container');
        let isDuplicated = false;

        duplicateBtn.addEventListener('click', function () {
            if (!isDuplicated) {
                const originalForm = document.querySelector('.person-form');
                const clonedForm = originalForm.cloneNode(true);

                // Update the cloned form fields' IDs and names
                clonedForm.querySelectorAll('input, select').forEach((element, index) => {
                    element.id = element.id.replace('0', '1');
                    element.name = element.name.replace('0', '1');
                    element.value = ''; // Clear the cloned input fields
                });

                formContainer.appendChild(clonedForm);
                isDuplicated = true;
            } else {
                alert('You can only add one additional Family Member.');
            }
        });
    });
</script>
@endsection
