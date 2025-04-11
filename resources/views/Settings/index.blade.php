@extends('../layout/' . $layout)

@section('subhead')
    <title>Settings- Admin Panel</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Set Flutterwave Keys
        </h2>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-12 2xl:col-span-12">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto"> Flutterwave Keys</h2>
                </div>
                <div class="p-5">
                    <form id="roleForm" method="POST" action="{{ route('admin-apikey-update') }}">
                        @csrf

                       
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 2xl:col-span-6">
                                <div class="mt-3">
                                    <label for="name" class="form-label">Flutterwave Public Key</label>
                                    <input id="name" name="flutterwave_public_key" type="text" class="form-control" placeholder="Flutterwave Public Key" value="{{$flutterwave_public_key->value}}" required>
                                </div>
                            </div>
                        </div>

                         <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 2xl:col-span-6">
                                <div class="mt-3">
                                    <label for="name" class="form-label">Flutterwave Secret Key</label>
                                    <input id="name" name="flutterwave_secret_key" type="text" class="form-control" placeholder="Flutterwave Secret Key" value="{{$flutterwave_secret_key->value}}" required>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 2xl:col-span-6">
                                <div class="mt-3">
                                    <label for="name" class="form-label">Flutterwave Encrypt Key</label>
                                    <input id="name" name="flutterwave_encrypt_key" type="text" class="form-control" placeholder="Flutterwave Encrypt Key" value="{{$Encryption_key->value}}" required>
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
