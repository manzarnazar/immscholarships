@extends('../layout/' . $layout)

@section('subhead')
    @isset($familyBackground)
        <title>Update Family Background - IMS - Scholarship Portal</title>
    @else
        <title>Create Family Background - IMS - Scholarship Portal</title>
    @endisset
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            @isset($familyBackground)
                Update Family Background
            @else
                Create Family Background
            @endisset
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-12 2xl:col-span-12">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Family Background Information  @if (!isset($familyBackground)) (Please Add Atleast Two Family Members Details)   @endif</h2>
                </div>
                <div class="p-5">
                    @if ($errors->has('family_members'))
    <div class="alert alert-danger">
        {{ $errors->first('family_members') }}
    </div>
@endif
                    <div class="flex flex-col-reverse xl:flex-row flex-col">
                        <div class="flex-1 mt-6 xl:mt-0">
                            <form id="updateForm" action="@isset($familyBackground){{ route('family-background-update', $familyBackground->id) }}@else{{ route('family-background-store') }}@endisset" method="POST" enctype="multipart/form-data">
                                @csrf
                                @isset($familyBackground)
                                    @method('PUT')
                                @endisset
                                <div id="form-container">
                                    <div class="person-form grid grid-cols-12 gap-x-5">
                                        <div class="col-span-12 2xl:col-span-6">
                                            <div class="mt-3">
                                                <label for="name" class="form-label">Full Name</label>


                                                <input name="name{{(! isset($familyBackground)) ? '[]' : ''}}" type="text" class="form-control" placeholder="Full Name" value="@isset($familyBackground){{ $familyBackground->name }}@endisset" required>
                                            </div>

                                            <div class="mt-3">
                                                <label for="relationship" class="form-label">Relationship</label>
                                                <select class="form-control" name="relationship{{(! isset($familyBackground)) ? '[]' : ''}}" required>
                                                    <option value="">Select Relationship</option>
                                                    <option value="Mother" @isset($familyBackground) @if($familyBackground->relationship == 'Mother') selected @endif @endisset>Mother</option>
                                                    <option value="Father" @isset($familyBackground) @if($familyBackground->relationship == 'Father') selected @endif @endisset>Father</option>
                                                    <option value="Sister" @isset($familyBackground) @if($familyBackground->relationship == 'Sister') selected @endif @endisset>Sister</option>
                                                    <option value="Brother" @isset($familyBackground) @if($familyBackground->relationship == 'Brother') selected @endif @endisset>Brother</option>
                                                    <option value="Uncle" @isset($familyBackground) @if($familyBackground->relationship == 'Uncle') selected @endif @endisset>Uncle</option>
                                                    <option value="Aunt" @isset($familyBackground) @if($familyBackground->relationship == 'Aunt') selected @endif @endisset>Aunt</option>
                                                    <option value="Grandmom" @isset($familyBackground) @if($familyBackground->relationship == 'Grandmom') selected @endif @endisset>Grandmom</option>
                                                    <option value="Grandpa" @isset($familyBackground) @if($familyBackground->relationship == 'Grandpa') selected @endif @endisset>Grandpa</option>
                                                </select>
                                            </div>

                                            <div class="mt-3">
                                                <label for="profession" class="form-label">Profession</label>
                                                <input name="profession{{(! isset($familyBackground)) ? '[]' : ''}}" type="text" class="form-control" placeholder="Profession" value="@isset($familyBackground){{ $familyBackground->profession }}@endisset" required>
                                            </div>

                                            <div class="mt-3">
                                                <label for="work_institution" class="form-label">Work Institution</label>
                                                <input name="work_institution{{(! isset($familyBackground)) ? '[]' : ''}}" type="text" class="form-control" placeholder="Work Institution" value="@isset($familyBackground){{ $familyBackground->work_institution }}@endisset" required>
                                            </div>
                                        </div>
                                        <div class="col-span-12 2xl:col-span-6 mt-3">
                                            <div class="mt-3">
                                                <label for="country" class="form-label">Country</label>
                                                <input name="country{{(! isset($familyBackground)) ? '[]' : ''}}" type="text" class="form-control" placeholder="Country" value="@isset($familyBackground){{ $familyBackground->country }}@endisset" required>
                                            </div>

                                            <div class="mt-3">
                                                <label for="mobile" class="form-label">Mobile</label>
                                                <input name="mobile{{(! isset($familyBackground)) ? '[]' : ''}}" type="text" class="form-control" placeholder="Mobile" value="@isset($familyBackground){{ $familyBackground->mobile }}@endisset" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (!isset($familyBackground))
                                    <button type="button" class="btn btn-warning mt-3" id="add-person-btn">Add Person</button>
                                @endif
                                <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
                            </form>
                        </div>
                        <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                            <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                <div class="mx-auto cursor-pointer relative mt-5">
                                    @isset($familyBackground)
                                        <button type="button" class="btn btn-secondary w-full" onclick="window.location.href='{{ route('family-background') }}'">Back to List</button>
                                    @else
                                        <button type="button" class="btn btn-secondary w-full" onclick="window.location.href='{{ route('family-background') }}'">Cancel</button>
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

    <!-- JavaScript for cloning the form fields -->
    <script>
        document.getElementById('add-person-btn').addEventListener('click', function() {
            var formContainer = document.getElementById('form-container');
            var newForm = formContainer.children[0].cloneNode(true);

            // Clear the values in the cloned form
            Array.from(newForm.querySelectorAll('input')).forEach(input => input.value = '');
            Array.from(newForm.querySelectorAll('select')).forEach(select => select.value = '');

            formContainer.appendChild(newForm);
        });
    </script>
@endsection
