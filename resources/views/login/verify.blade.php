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
                    <img alt="IMS Scholarship Portal" class="w-6" src="{{ asset('ims_logo.png') }}">
                    <span class="text-white text-lg ml-3">
                        IMS
                    </span>
                </a>
                <div class="my-auto">
                      <!-- Replace image with text -->
                      <span class="-intro-x text-8xl font-semibold text-green-600 tracking-wide">
                        IMS
                    </span>
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">One click to <br> Verify your account.</div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">IMS Scholarship Portal</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
<div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
    <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center">{{ __('Please verify your email address to continue') }}</h2>
        <div class="intro-x mt-2 text-slate-900 dark:text-slate-200 text-lg font-medium text-center">
            {{ __('Check your inbox for the verification email.') }}
            <br>
            {{ __('If you didn’t receive it, click below to request another one.') }}
        </div>

        <!-- Success Message (if the verification link was resent) -->
        @if (session('resent'))
            <div class="intro-x mt-8 alert alert-success text-center p-4 rounded-md shadow-sm bg-green-50 text-green-700">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
            <form class="text-center" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-primary py-3 px-6 w-full xl:w-40 xl:mr-3 align-top rounded-lg shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300">
                    {{ __('Request Another') }}
                </button>
            </form>
        </div>
    </div>
</div>
