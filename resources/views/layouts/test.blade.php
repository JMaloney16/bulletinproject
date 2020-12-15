<!-- Stored in resources/views/layouts/test.blade.php -->

<html>
    <head>
        <title>Billboard - @yield('title')</title>
    </head>
    <body>
        <h1>Billboard - @yield('title')</h1>
        <a href="{{ route('dashboard') }}">Login</a>
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
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>