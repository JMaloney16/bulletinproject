<!-- Stored in resources/views/layouts/test.blade.php -->

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
        <title>Billboard - @yield('title')</title>
    </head>
    <body class="font-sans antialiased">
        
        <div class="bg-gray-100">
            @if (Route::has('login'))
                    @auth
                        @livewire('navigation-dropdown')
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endif
                </div>
            @endif

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h1 class="font-semibold text-xl text-gray-800 leading-tight">Billboard - @yield('title')</h1>
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
            @if (session('message'))
                <p><b>{{ session('message') }}</b></p>
            @endif
            <div class="container mx-auto">
                @yield('content')
            </div> 
            </main>

        
        </div>
        @stack('modals')

        @livewireScripts
        
    </body>
</html>