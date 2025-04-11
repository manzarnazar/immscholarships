@extends('../layout/' . $layout)

@section('head')
    <title>OTP - IMS</title>
@endsection

@section('content')
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    {{-- <img alt="IMS Scholarship Portal" class="w-6" src="{{ asset('ims_logo.png') }}"> --}}
                    <span class="text-green-600 text-lg ml-3">
                        IMS
                    </span>
                </a>
                <div class="my-auto">
                    <!-- Replace image with text -->
                    <span class="-intro-x text-8xl font-semibold text-green-600 tracking-wide">
                        IMS
                    </span>

                    <!-- Your additional text -->
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                       Enter OTP TO  <br> sign in to your account.
                    </div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">
                        Welcome to the IMS Scholarship Portal
                    </div>
                </div>

            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Enter OTP</h2>
                    <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">A few more clicks to sign in to your account. IMS Scholarship Portal</div>

                      @if($errors->has('otp'))
    <div class="alert alert-danger">
        {{ $errors->first('otp') }}
    </div>
@endif
                    <div class="intro-x mt-8 pt-5">

                        <form  method="POST" action="{{ route('verifyadmin.otp') }}">
                            @csrf 
                            <input id="email" type="text"  name="otp" class="intro-x login__input form-control py-3 px-4 block" placeholder="Enter OTP" required>
                            @error('email')
                            <div id="error-email" class="login__input-error text-danger mt-2">{{ $message }}</div>
                            @enderror
                         
                            
                       
                    </div>
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button type="submit" id="btn-login" style="background: white; color: black;" class=" py-3 px-4 w-full xl:w-32 xl:mr-3 align-top btn btn-primary">Submit</button>
                      
                    </div>
                    </form>
                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div>
@endsection

@section('script')


  <!--   <script>
        (function () {
            async function login() {
                // Reset state
                $('#login-form').find('.login__input').removeClass('border-danger')
                $('#login-form').find('.login__input-error').html('')

                // Post form
                let email = $('#email').val()
                let password = $('#password').val()

                // Loading state
                $('#btn-login').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>')
                tailwind.svgLoader()
                await helper.delay(1500)

                axios.post(`login`, {
                    email: email,
                    password: password
                }).then(res => {
                    location.href = '/dashboard/home/'
                }).catch(err => {
                    $('#btn-login').html('Login')
                    if (err.response.data.message != 'Wrong email or password.') {
                        for (const [key, val] of Object.entries(err.response.data.errors)) {
                            $(`#${key}`).addClass('border-danger')
                            $(`#error-${key}`).html(val)
                        }
                    } else {
                        $(`#password`).addClass('border-danger')
                        $(`#error-password`).html(err.response.data.message)
                    }
                })
            }

            $('#login-form').on('keyup', function(e) {
                if (e.keyCode === 13) {
                    login()
                }
            })

            $('#btn-login').on('click', function() {
                login()
            })
        })()
    </script> -->
@endsection
