@extends('../layout/' . $layout)

@section('head')
    <title>Login - IMS</title>
@endsection

@section('content')
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4 min-h-screen">
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

            <!-- BEGIN: Login Form -->
            <div class="flex xl:items-center py-5 xl:py-0 my-10 xl:my-0 overflow-y-auto">
                <div class="mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Sign In</h2>
                    <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">
                        A few more clicks to sign in to your account. IMS Scholarship Portal
                    </div>

                    <div class="intro-x mt-8">
                        <form id="login-form">
                            <input id="email" type="text" class="intro-x login__input form-control py-3 px-4 block" placeholder="Email" value="">
                            @error('email')
                            <div id="error-email" class="login__input-error text-danger mt-2">{{ $message }}</div>
                            @enderror

                            <input id="password" type="password" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Password">
                            @error('password')
                            <div id="error-password" class="login__input-error text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </form>
                    </div>

                    <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                        <div class="flex items-center mr-auto">
                            <input id="remember-me" type="checkbox" class="form-check-input border mr-2">
                            <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                        </div>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                        @endif
                    </div>

                    <!-- Terms and Conditions (Responsive) -->
                    <div class="intro-x mt-5 text-sm text-gray-800 dark:text-gray-200 leading-relaxed w-full">
                        <div class="intro-x mt-5 text-sm leading-relaxed w-full">
                            <div class="flex items-start w-full">
                            <input id="agree-terms" type="checkbox" class="form-check-input mt-1 mr-2 shrink-0">
                            <label for="agree-terms" style="color: #1f2937 !important;" class="cursor-pointer w-full break-words">
                                I agree to the 
                                <a class="text-primary underline" href="https://imsscholarships.com/terms-and-conditions/" target="_blank">Terms and Conditions</a> 
                                and 
                                <a class="text-primary underline" href="https://imsscholarships.com/privacy-policy/" target="_blank">Privacy Policy</a>.
                            </label>
                        </div>
                    </div>

                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button type="submit" id="btn-login" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Login</button>
                        <a href="{{ '/register' }}" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Register</a>
                    </div>
                </div>
            </div>

            <!-- END: Login Form -->
        </div>
    </div>
@endsection

@section('script')
<script>
    (function () {
        async function login() {
            $('#login-form').find('.form-control').removeClass('border-danger');
            $('#login-form').find('.login__input-error').html('');

            let email = $('#email').val();
            let password = $('#password').val();

            if (!$('#agree-terms').is(':checked')) {
                alert("Please agree to the Terms and Conditions before logging in.");
                return;
            }

            $('#btn-login').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>');
            tailwind.svgLoader();
            await helper.delay(1500);

            axios.post(`login`, {
                email: email,
                password: password
            }).then(res => {
                if (res.data.redirect) {
                    location.href = res.data.redirect;
                }
            }).catch(err => {
                $('#btn-login').html('Login');
                if (err.response.data.message !== 'Wrong email or password.') {
                    for (const [key, val] of Object.entries(err.response.data.errors)) {
                        $(`#${key}`).addClass('border-danger');
                        $(`#error-${key}`).html(val);
                    }
                } else {
                    $(`#password`).addClass('border-danger');
                    $(`#error-password`).html(err.response.data.message);
                }
            });
        }

        $('#login-form').on('keyup', function (e) {
            if (e.keyCode === 13) {
                login();
            }
        });

        $('#btn-login').on('click', function () {
            login();
        });
    })();
</script>
@endsection
