@extends('../layout/' . $layout)

@section('subhead')
    @isset($course)
        <title>Update Course - IMS - Scholarship Portal</title>
    @else
        <title>Create Course - IMS - Scholarship Portal</title>
    @endisset
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            @isset($course)
                Update Course
            @else
                Create Course
            @endisset
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-12 2xl:col-span-12">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Course Information</h2>
                </div>
                <div class="p-5">
                    <form id="courseForm" method="POST" action="@isset($course){{ route('admin-courses-update', $course->id) }}@else{{ route('admin-scholarships-store') }}@endisset" enctype="multipart/form-data">
                        @csrf
                        @isset($course)
                            @method('PUT')
                        @endisset

                        <div class="grid grid-cols-12 gap-x-5">
                            <!-- Course Name -->
                            <div class="col-span-12 2xl:col-span-6">
                                <div class="mt-3">
                                    <label for="title" class="form-label">Course Name</label>
                                    <input id="title" name="title" type="text" class="form-control" placeholder="Course Name" value="@isset($course){{ $course->title }}@endisset">
                                </div>
                            </div>

                            <!-- University -->
                            <div class="col-span-12 2xl:col-span-6 mt-3">
                                <div>
                                    <label for="institution_id" class="form-label">University</label>
                                    <?php
                                    use App\Models\Institutions;
                                    $institutions = Institutions::pluck('name', 'id');
                                    ?>
                                    <select name="institution_id" id="institution_id" class="form-control show-tick ms select2" data-placeholder="Select University">
                                        <option value="">Select University</option>
                                        @foreach ($institutions as $id => $institution)
                                            <option value="{{ $id }}" @isset($course) @if ($course->institution_id == $id) selected @endif @endisset>
                                                {{ strtoupper($institution) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-span-12 mt-3">
                                <div>
                                    <label for="description" class="form-label">Description</label>
                                    <textarea id="description" name="description" class="form-control" placeholder="Description">@isset($course){{ $course->description }}@endisset</textarea>
                                </div>
                            </div>

                            <!-- Teaching Language -->
                            <div class="col-span-12 2xl:col-span-6 mt-3">
                                <div>
                                    <label for="teaching_language" class="form-label">Teaching Language</label>
                                    <select name="teaching_language" id="teaching_language" class="form-control">
                                        <option value="">Select Teaching Language</option>
                                        <option value="chinese" @isset($course) @if ($course->teaching_language == 'chinese') selected @endif @endisset>CHINESE</option>
                                        <option value="english" @isset($course) @if ($course->teaching_language == 'english') selected @endif @endisset>ENGLISH</option>
                                        <option value="russian" @isset($course) @if ($course->teaching_language == 'russian') selected @endif @endisset>RUSSIAN</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Cover Image -->
                            <div class="col-span-12 2xl:col-span-6 mt-3">
                                <div>
                                    <label for="image_path" class="form-label">Cover Image</label>
                                    <input type="file" id="image_path" name="image_path" class="form-control">
                                    @isset($course)
                                        <img src="{{ asset('storage/'.$course->image_path) }}" alt="Cover Image" class="mt-2" style="max-width: 200px;">
                                    @endisset
                                </div>
                            </div>

                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end mt-4">
                            <button type="submit" class="btn btn-primary w-20">Save</button>
                        </div>
                    </form>
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
                .create(document.querySelector('#description'))
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endsection
