@extends('../layout/' . $layout)

@section('subhead')
    <title>Password Update- IMS</title>
@endsection

@section('subcontent')
   <!--  <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto"> Password Update | Home</h2>
    </div> -->

    <div class="grid grid-cols-12 gap-6">
        <!-- Profile Details Section -->
       
       

          <!-- admin staff -->

            
        <div class="col-span-12 md:col-span-8 xl:col-span-9">
            <div class="intro-y box">
                <div class="p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    @foreach ($errors->all() as $error)
    <!-- <div class="alert alert-danger">{{ $error }}</div> -->
@endforeach
                    <h2 class="font-medium text-base mr-auto text-primary"> Password Update</h2>
                </div>
            <div class="p-5">
    <h5 class="text-xl font-medium">Change Password</h5>
    <form action="{{ route('SaveupdatePassword') }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')

        <!-- Current Password -->
        <div class="mb-4">
            <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
            <input type="password" id="current_password" name="current_password" 
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
        </div>

        <!-- New Password -->
        <div class="mb-4">
            <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
            <input type="password" id="new_password" name="new_password" 
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
        </div>

        <!-- Confirm New Password -->
        <div class="mb-4">
            <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" 
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-full">
            Change Password
        </button>
    </form>
</div>
            </div>
        </div>
       
    </div>
@endsection
