<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    
    
    
    @if (Request::is('login') || Request::is('register'))
    <!-- BEGIN: Minimal WhatsApp Chat Button -->
    <div class="fixed bottom-24 right-6 z-[9999]">
        <a href="https://wa.me/8619502997569" target="_blank"
           class="flex items-center gap-2 bg-white/80 backdrop-blur-md border border-green-500 text-green-700 font-semibold shadow-md hover:shadow-lg px-4 py-2 rounded-full transition-all duration-300 hover:scale-105">
            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                <path d="M16.17 14.27c-.28-.14-1.65-.81-1.9-.9-.25-.1-.43-.14-.6.14-.18.28-.7.9-.85 1.1-.16.18-.3.2-.57.07-.28-.14-1.18-.43-2.24-1.4-.83-.74-1.4-1.65-1.57-1.92-.16-.28-.02-.43.12-.57.13-.13.28-.32.43-.48.14-.18.18-.28.28-.46.1-.14.05-.32-.02-.46-.07-.14-.6-1.44-.83-1.97-.22-.53-.44-.46-.6-.46h-.5c-.14 0-.36.05-.57.28s-.75.74-.75 1.82.77 2.11.88 2.25c.1.14 1.5 2.36 3.64 3.31 1.27.55 1.77.6 2.4.5.38-.06 1.18-.48 1.35-.95.16-.46.16-.85.1-.94-.05-.1-.27-.18-.55-.32z"/>
                <path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12c0 1.82.49 3.52 1.34 5L2 22l5.18-1.34C8.48 21.51 10.18 22 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2zm-8 10c0-4.41 3.59-8 8-8s8 3.59 8 8-3.59 8-8 8c-1.61 0-3.11-.49-4.34-1.34L4 20l1.34-4.34C4.49 15.11 4 13.61 4 12z" clip-rule="evenodd"/>
            </svg>
            <span class="text-sm">Chat with IMS</span>
        </a>
    </div>
    <!-- END: Minimal WhatsApp Chat Button -->
    @endif
    
    
<script src="//unpkg.com/alpinejs" defer></script>


    
</body>
</html>
