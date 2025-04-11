@extends('../layout/' . $layout)

@section('subhead')
    @isset($chineseAbility)
        <title>Update Chinese Ability - IMS - Scholarship Portal</title>
    @else
        <title>Create Chinese Ability - IMS - Scholarship Portal</title>
    @endisset
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            @isset($chineseAbility)
                Update Chinese Ability
            @else
                Create Chinese Ability
            @endisset
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-12 2xl:col-span-12">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Chinese Ability Information</h2>
                </div>
                <div class="p-5">
                    <div class="flex flex-col-reverse xl:flex-row flex-col">
                        <div class="flex-1 mt-6 xl:mt-0">
                            <form id="updateForm" action="@isset($chineseAbility){{ route('chinese-ability-update', $chineseAbility->id) }}@else{{ route('chinese-ability-store') }}@endisset" method="POST" enctype="multipart/form-data">
                                @csrf
                                @isset($chineseAbility)
                                    @method('PUT')
                                @endisset
                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 2xl:col-span-6">
                                        <div class="mt-3">
                                            <label for="update-chinese-ability-form-1" class="form-label">Current Chinese Level</label>
                                            <select id="update-chinese-ability-form-1" name="chinese_level" class="form-control">
                                                <option value="">Select Chinese Level</option>
                                                <option value="good" @isset($chineseAbility){{ $chineseAbility->chinese_level == 'good' ? 'selected' : '' }}@endisset>Good</option>
                                                <option value="very-good" @isset($chineseAbility){{ $chineseAbility->chinese_level == 'very-good' ? 'selected' : '' }}@endisset>Very Good</option>
                                                <option value="excellent" @isset($chineseAbility){{ $chineseAbility->chinese_level == 'excellent' ? 'selected' : '' }}@endisset>Excellent</option>
                                                <option value="begineer" @isset($chineseAbility){{ $chineseAbility->chinese_level == 'begineer' ? 'selected' : '' }}@endisset>Beginner</option>
                                                <option value="begineer" @isset($chineseAbility){{ $chineseAbility->chinese_level == 'Poor' ? 'selected' : '' }}@endisset>Poor</option>
                                            </select>
                                        </div>

                                        <div class="mt-3">
                                            <label for="update-chinese-ability-form-2" class="form-label">HSK Score</label>
                                            <input id="update-chinese-ability-form-2" name="hsk_score" type="text" class="form-control" placeholder="HSK Score" value="@isset($chineseAbility){{ $chineseAbility->hsk_score }}@endisset">
                                        </div>
                                    </div>

                                    <div class="col-span-12 2xl:col-span-6 mt-3">
                                        <div class="mt-3">
                                            <label for="update-chinese-ability-form-3" class="form-label">HSKK Grade</label>
                                            <input id="update-chinese-ability-form-3" name="hskk_grade" type="text" class="form-control" placeholder="HSKK Grade" value="@isset($chineseAbility){{ $chineseAbility->hskk_grade }}@endisset">
                                        </div>

                                        <div class="mt-3">
                                            <label for="update-chinese-ability-form-4" class="form-label">HSSK Score</label>
                                            <input id="update-chinese-ability-form-4" name="hssk_score" type="text" class="form-control" placeholder="HSSK Score" value="@isset($chineseAbility){{ $chineseAbility->hssk_score }}@endisset">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
                            </form>
                        </div>
                        @isset($chineseAbility)
                        <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                            <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                <div class="mx-auto cursor-pointer relative mt-5">

                                        <button type="button" class="btn btn-secondary w-full" onclick="window.location.href='{{ route('chinese-ability') }}'">Back to List</button>

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
