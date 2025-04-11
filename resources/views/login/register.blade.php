@extends('../layout/' . $layout)

@section('head')
    <title>Login - IMS</title>
@endsection

@section('content')
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <span class="text-green-600 text-lg ml-3">IMS</span>
                </a>
                <div class="my-auto">
                    <span class="-intro-x text-8xl font-semibold text-green-600 tracking-wide">IMS</span>
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                        A few more clicks to <br> sign in to your account.
                    </div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">
                        Welcome to the IMS Scholarship Portal
                    </div>
                </div>
            </div>
            <!-- END: Login Info -->

            <!-- BEGIN: Sign Up Form -->
            <div class="min-h-screen xl:h-auto flex flex-col justify-center py-5 xl:py-0 xl:my-0">
                <div class="mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Sign Up</h2>
                    <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">
                        A few more clicks to sign in to your account. IMS Scholarship Portal
                    </div>

                    <div class="intro-x mt-8">
                        <form id="login-form" method="POST" action="{{ route('register') }}">
                            @csrf
                            <input type="text" name="name" class="intro-x login__input form-control py-3 px-4 block" placeholder="Full name" value="{{ old('name') }}">
                            @error('name')
                            <div id="error-full_name" class="login__input-error text-danger mt-2">{{ $message }}</div>
                            @enderror

                            <input id="email" type="email" name="email" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Email" value="{{ old('email') }}">
                            @error('email')
                            <div id="error-email" class="login__input-error text-danger mt-2">{{ $message }}</div>
                            @enderror

                            <input id="number" type="text" name="whatsappNumber" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Please Enter Whatsapp Number with Country Code" value="{{ old('whatsappNumber') }}" pattern="\+\d{1,3}\d{4,14}$" required title="Please include the country code (e.g., +1 for USA).">
                            @error('whatsappNumber')
                            <div id="error-number" class="login__input-error text-danger mt-2">{{ $message }}</div>
                            @enderror

                            @php
                                use App\Models\Countries as CountryModel;
                                $countries = CountryModel::orderBy('name', 'asc')->pluck('name', 'id');
                            @endphp
                            <select name="country_origin" id="country" class="form-control intro-x login__input py-3 px-4 block mt-4">
                                <option value="">Select Country of nationality</option>
                                @foreach ($countries as $id => $name)
                                    <option value="{{ $name }}" @if(old('country_origin') == $name) selected @endif>{{ strtoupper($name) }}</option>
                                @endforeach
                            </select>

                            <select name="education_level" id="education_level" class="form-control intro-x login__input py-3 px-4 block mt-4" required>
                                <option value="">Select Education level</option>
                                <option value="Bachelor">Bachelor Degree</option>
                                <option value="master">Master Degree</option>
                                <option value="PHD">PHD Degree</option>
                            </select>

                            <input id="password" type="password" name="password" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Password" value="">
                            @error('password')
                            <div id="error-password" class="login__input-error text-danger mt-2">{{ $message }}</div>
                            @enderror

                            <input type="password" name="password_confirmation" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Confirm Password">

                            <input type="text" name="referral_code" value="{{ request('ref') }}" placeholder="Enter Referral Code (optional)" class="intro-x login__input form-control py-3 px-4 block mt-4">

                            <!-- Terms & Conditions Checkbox -->
                            <div class="mt-4 text-sm text-gray-800 dark:text-gray-200 leading-relaxed w-full">
    <div class="flex items-start">
        <input id="terms" type="checkbox" name="terms" class="form-check-input mt-1 mr-2 shrink-0" required>
        <label for="terms" class="cursor-pointer w-full break-words">
        <label for="terms" style="color: #1f2937 !important;" class="cursor-pointer w-full break-words">    
            I agree to the
            <a class="text-primary underline" href="https://imsscholarships.com/terms-and-conditions/" target="_blank">Terms and Conditions</a>
            and
            <a class="text-primary underline" href="https://imsscholarships.com/privacy-policy/" target="_blank">Privacy Policy</a>.
        </label>
    </div>
</div>

<div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
    <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Register</button>
    <a href="{{ '/login' }}" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Login</a>
</div>

<div class="intro-x mt-10 xl:mt-24 text-slate-600 dark:text-slate-500 text-center xl:text-left">
    By signing up, you agree to our
    <a class="text-primary dark:text-slate-200" href="https://imsscholarships.com/terms-and-conditions/">Terms and Conditions</a> &
    <a class="text-primary dark:text-slate-200" href="https://imsscholarships.com/privacy-policy/">Privacy Policy</a>
</div>
            <!-- END: Sign Up Form -->
        </div>
    </div>
@endsection

@section('script')
<script>
    // Optional form logic here
</script>
@endsection