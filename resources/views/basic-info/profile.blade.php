@extends('../layout/' . $layout)

@section('subhead')
    <title>Student Profile - IMS</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto"> Profile | Home</h2>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <!-- Profile Details Section -->
        <div class="col-span-12 md:col-span-4 xl:col-span-3">
            <div class="intro-y box mb-6">
                <div class="p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Profile Details</h2>
                </div>
                <div class="p-5 text-center">
                    @foreach ($student as $profile)
                        <img src="{{ asset($profile->image_path) ?? asset('default.jpg') }}" alt="Profile Image"
                             class="img-fluid rounded-circle mb-2 w-32 h-32 object-cover" />
                    @endforeach

                    <h5 class="font-medium text-xl">{{ Auth::user()->name }}</h5>
                    <a class="inline-block mt-2 bg-blue-500 text-white text-xs py-1 px-3 rounded-full"
                       href="#">{{ strtoupper(Auth::user()->user_type) }}</a>
                </div>
                <div class="p-5">
                    <h5 class="text-sm text-gray-500">Contact Details</h5>
                    <p>Email Address: <strong>{{ Auth::user()->email }}</strong></p>
                </div>
            </div>
        </div>

        <!-- Student Information Section -->
          @if(auth()->user()->user_type == 'student')
        <div class="col-span-12 md:col-span-8 xl:col-span-9">
            <div class="intro-y box">
                <div class="p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto text-primary">Student Basic Information</h2>
                </div>
                <div class="p-5">
                    @forelse ($student as $item)
                        <div class="grid grid-cols-12 gap-5">
                            <div class="col-span-12 md:col-span-4">
                                <p>First Name: <strong>{{ $item->first_name }}</strong></p>
                            </div>
                            <div class="col-span-12 md:col-span-4">
                                <p>Middle Name: <strong>{{ $item->middle_name }}</strong></p>
                            </div>
                            <div class="col-span-12 md:col-span-4">
                                <p>Last Name: <strong>{{ $item->last_name }}</strong></p>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-5 mt-4">
                            <div class="col-span-12 md:col-span-4">
                                <p>Date of Birth: <strong>{{ $item->dob }}</strong></p>
                            </div>
                            <div class="col-span-12 md:col-span-4">
                                <p>Birth Place: <strong>{{ $item->place_of_birth }}</strong></p>
                            </div>
                            <div class="col-span-12 md:col-span-4">
                                <p>Gender: <strong>{{ $item->gender }}</strong></p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-danger text-xl">No Information available</p>
                    @endforelse
                        
                    <!-- Education Background Section -->
                    <div class="mt-6">
                        <h5 class="text-primary text-xl">Education Background</h5>
                        <p class="text-success">Bachelor Degree</p>
                        @forelse ($degreeEducation as $degree)
                            <div class="grid grid-cols-12 gap-5 mt-4">
                                <div class="col-span-12 md:col-span-4">
                                    <p>Start Date: <strong>{{ $degree->start_date }}</strong></p>
                                </div>
                                <div class="col-span-12 md:col-span-4">
                                    <p>End Date: <strong>{{ $degree->end_date }}</strong></p>
                                </div>
                                <div class="col-span-12 md:col-span-4">
                                    <p>Institution: <strong>{{ $degree->institution_name }}</strong></p>
                                </div>
                            </div>

                            <div class="grid grid-cols-12 gap-5 mt-4">
                                <div class="col-span-12 md:col-span-4">
                                    <p>Course: <strong>{{ $degree->major_subject }}</strong></p>
                                </div>
                                <div class="col-span-12 md:col-span-4">
                                    <p>Award: <strong>{{ $degree->award }}</strong></p>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-danger">No Bachelor Degree Information available</p>
                        @endforelse

                        <!-- High School / Diploma Education -->
                        <p class="text-success mt-4">Highschool/Diploma Education</p>
                        @forelse ($diplomaEducation as $diploma)
                            <div class="grid grid-cols-12 gap-5 mt-4">
                                <div class="col-span-12 md:col-span-4">
                                    <p>Start Date: <strong>{{ $diploma->start_date }}</strong></p>
                                </div>
                                <div class="col-span-12 md:col-span-4">
                                    <p>End Date: <strong>{{ $diploma->end_date }}</strong></p>
                                </div>
                                <div class="col-span-12 md:col-span-4">
                                    <p>Institution: <strong>{{ $diploma->institution_name }}</strong></p>
                                </div>
                            </div>

                            <div class="grid grid-cols-12 gap-5 mt-4">
                                <div class="col-span-12 md:col-span-4">
                                    <p>Course: <strong>{{ $diploma->major_subject }}</strong></p>
                                </div>
                                <div class="col-span-12 md:col-span-4">
                                    <p>Award: <strong>{{ $diploma->award }}</strong></p>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-danger">No Highschool/Diploma Information available</p>
                        @endforelse

                        <!-- Secondary Education -->
                        <p class="text-success mt-4">Secondary Education</p>
                        @forelse ($secondaryEducation as $secondary)
                            <div class="grid grid-cols-12 gap-5 mt-4">
                                <div class="col-span-12 md:col-span-4">
                                    <p>Start Date: <strong>{{ $secondary->start_date }}</strong></p>
                                </div>
                                <div class="col-span-12 md:col-span-4">
                                    <p>End Date: <strong>{{ $secondary->end_date }}</strong></p>
                                </div>
                                <div class="col-span-12 md:col-span-4">
                                    <p>Institution: <strong>{{ $secondary->institution_name }}</strong></p>
                                </div>
                            </div>

                            <div class="grid grid-cols-12 gap-5 mt-4">
                                <div class="col-span-12 md:col-span-4">
                                    <p>Course: <strong>{{ $secondary->major_subject }}</strong></p>
                                </div>
                                <div class="col-span-12 md:col-span-4">
                                    <p>Award: <strong>{{ $secondary->award }}</strong></p>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-danger">No Secondary Education Information available</p>
                        @endforelse


                       <form action="{{ route('update-education-level') }}" method="POST" class="mt-5">
    @csrf
    
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12 md:col-span-4 pt-5">
            <p class="text-success mt-4">Education Level</p>
        </div>

        <div class="col-span-12 md:col-span-8">
            @php
                $currentLevel = auth()->user()->education_level ?? '';  
                $educationLevels = [
                    'Bachelor' => 'Bachelor Degree',
                    'master' => 'Master Degree',
                    'PHD' => 'PHD Degree',
                ];
            @endphp

            <select name="education_level" id="education_level" class="form-control intro-x login__input py-3 px-4 block mt-4" required>
                <option value="">Select Education Level</option>
                @foreach ($educationLevels as $value => $label)
                    <option value="{{ $value }}" {{ $currentLevel === $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-span-12 mt-5">
            <button type="submit" class="btn btn-primary">Update Education Level</button>
        </div>
    </div>
</form>
  

                    </div>

              
                </div>
            </div>
        </div>
          @endif



          <!-- admin staff -->

                 @if(auth()->user()->user_type == 'super-admin' || auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff')
        <div class="col-span-12 md:col-span-8 xl:col-span-9">
            <div class="intro-y box">
                <div class="p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto text-primary">Admin Information</h2>
                </div>
                <div class="p-5">
                  <div class="p-5">


    <form action="{{ route('admin.updateProfileAdmin') }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" name="name" 
                   value="{{ Auth::user()->name }}" 
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" 
                   value="{{ Auth::user()->email }}" 
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" readonly>
        </div>

        <!-- Profile Image -->
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Profile Image</label>
            <input type="file" id="image" name="image" 
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-full">
            Update Profile
        </button>
    </form>
</div>
              
                </div>
            </div>
        </div>
          @endif
    </div>
@endsection
