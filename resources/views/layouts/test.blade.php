<!-- Stored in resources/views/layouts/test.blade.php -->

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @livewireStyles
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
    <title>Bulletin Project - @yield('title')</title>
</head>

<body class="font-sans antialiased">

    <div class="bg-bg-autumn">
        @if (Route::has('login'))
            @auth
                @livewire('navigation-dropdown')
            @else
                <div class="bg-bg-sea w-full">
                    <div class="bg-bg-sea flex max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <a href="{{ route('login') }}" class="text-sm text-gray-100 underline">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-100 underline">Register</a>
                        @endif
                    </div>
                </div>
            @endif
            @endif

            <!-- Page Heading -->
            <header class="bg-bg-deepsea shadow">
                <div class="flex justify-between max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h1 class="font-semibold text-xl text-gray-200 leading-tight">Bulletin Board - @yield('title')</h1>
                    <h2 class="mx-2">
                        @livewire('comment-notification')
                    </h2>
                    <div>
                        @if (session('message'))
                            <p class="py-4 text-gray-100"><b>{{ session('message') }}</b></p>
                        @endif
                        @yield('headerBar')
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                @if ($errors->any())
                    <div>
                        Errors:
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="container mx-auto py-4">
                    @yield('content')
                </div>
            </main>


        </div>
        @stack('modals')

        @livewireScripts

        </div>
    </body>

    </html>
