@extends('../layout/' . $layout)

@section('subhead')
    <title>Register New User - Admin Panel</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Register New User
        </h2>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-12 2xl:col-span-12">
            <!-- BEGIN: User Registration Form -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">User Information</h2>
                </div>
                <div class="p-5">
                    <form id="categoryForm" method="POST" action="{{ route('admin-users-management-store') }}">
                        @csrf

                        <div class="grid grid-cols-12 gap-6">
                            <!-- Name Input and Email Input on Same Row -->
                            <div class="col-span-12 sm:col-span-6">
                                <div class="mt-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input id="name" name="name" type="text" class="form-control" placeholder="Name">
                                </div>
                            </div>

                            <div class="col-span-12 sm:col-span-6 mt-3 sm:mt-0">
                                <div>
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" name="email" type="email" class="form-control" placeholder="Email Address">
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-6 mt-3">
                            <!-- Password Input and Role Select on Same Row -->
                            <div class="col-span-12 sm:col-span-6">
                                <div class="mt-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                                </div>
                            </div>

                            <div class="col-span-12 sm:col-span-6 mt-3 sm:mt-0">
                                <div>
                                    <label for="user_type" class="form-label">Select Role</label>
                                    <?php
                                    use App\Models\Roles;
                                    $categories = Roles::pluck('name', 'id');
                                    ?>
                                    <select name="user_type" id="user_type" class="form-control show-tick ms select2" data-placeholder="Select Role">
                                        <option value="">Select Role</option>
                                        <?php foreach ($categories as $id => $name): ?>
                                            <option value="<?= $name ?>"><?= strtoupper($name) ?></option>
                                        <?php endforeach; ?>
                                    </select>
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
            <!-- END: User Registration Form -->
        </div>
    </div>
@endsection
