@extends('../layout/' . $layout)

@section('subhead')
    @isset($englishAbility)
        <title>Update English Ability - IMS - Scholarship Portal</title>
    @else
        <title>Create English Ability - IMS - Scholarship Portal</title>
    @endisset
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            @isset($englishAbility)
                Update English Ability
            @else
                Create English Ability
            @endisset
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-12 2xl:col-span-12">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">English Ability Information</h2>
                </div>
                <div class="p-5">
                    <div class="flex flex-col-reverse xl:flex-row flex-col">
                        <div class="flex-1 mt-6 xl:mt-0">
                            <form id="updateForm" action="@isset($englishAbility){{ route('english-ability-update', $englishAbility->id) }}@else{{ route('english-ability-store') }}@endisset" method="POST" enctype="multipart/form-data">
                                @csrf
                                @isset($englishAbility)
                                    @method('PUT')
                                @endisset
                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 2xl:col-span-6">
                                        <div class="mt-3">
                                            <label for="update-english-ability-form-1" class="form-label">Current English Level</label>
                                            <!-- <input id="update-english-ability-form-1" name="english_level" type="text" class="form-control" placeholder="Input text" value="@isset($englishAbility){{ $englishAbility->english_level }}@endisset"> -->


                                              <select id="update-chinese-ability-form-1" name="english_level" class="form-control">
                                                <option value="">Current English Level</option>
                                                <option value="good" @isset($englishAbility){{ $englishAbility->english_level == 'good' ? 'selected' : '' }}@endisset>Good</option>
                                                <option value="very-good" @isset($englishAbility){{ $englishAbility->english_level == 'very-good' ? 'selected' : '' }}@endisset>Very Good</option>
                                                <option value="excellent" @isset($englishAbility){{ $englishAbility->english_level == 'excellent' ? 'selected' : '' }}@endisset>Excellent</option>
                                                <option value="begineer" @isset($englishAbility){{ $englishAbility->english_level == 'begineer' ? 'selected' : '' }}@endisset>Beginner</option>
                                                <option value="begineer" @isset($englishAbility){{ $englishAbility->english_level == 'Poor' ? 'selected' : '' }}@endisset>Poor</option>
                                            </select>
                                        </div>

                                        <div class="mt-3">
                                            <label for="update-english-ability-form-2" class="form-label">TOEFL</label>
                                            <input id="update-english-ability-form-2" name="toefl" type="text" class="form-control" placeholder="Input text" value="@isset($englishAbility){{ $englishAbility->toefl }}@endisset">
                                        </div>

                                        <div class="mt-3">
                                            <label for="update-english-ability-form-3" class="form-label">IELTS</label>
                                            <input id="update-english-ability-form-3" name="ielts" type="text" class="form-control" placeholder="Input text" value="@isset($englishAbility){{ $englishAbility->ielts }}@endisset">
                                        </div>
                                    </div>

                                    <div class="col-span-12 2xl:col-span-6 mt-3">
                                        <div class="mt-3">
                                            <label for="update-english-ability-form-4" class="form-label">GRE</label>
                                            <input id="update-english-ability-form-4" name="gre" type="text" class="form-control" placeholder="Input text" value="@isset($englishAbility){{ $englishAbility->gre }}@endisset">
                                        </div>

                                        <div class="mt-3">
                                            <label for="update-english-ability-form-5" class="form-label">GMAT</label>
                                            <input id="update-english-ability-form-5" name="gmat" type="text" class="form-control" placeholder="Input text" value="@isset($englishAbility){{ $englishAbility->gmat }}@endisset">
                                        </div>

                                        <div class="mt-3">
                                            <label for="update-english-ability-form-6" class="form-label">Other Language Competences</label>
                                            <input id="update-english-ability-form-6" name="other" type="text" class="form-control" placeholder="Input text" value="@isset($englishAbility){{ $englishAbility->other }}@endisset">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
                            </form>
                        </div>
                        @isset($englishAbility)
                        <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                            <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                <div class="mx-auto cursor-pointer relative mt-5">
                                        <button type="button" class="btn btn-secondary w-full" onclick="window.location.href='{{ route('english-ability') }}'">Back to List</button>

                                    </div>
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
