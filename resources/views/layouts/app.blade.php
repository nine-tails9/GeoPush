<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>
<body>
    <div id="app">

        <nav class="navbar is-info">
            <div class="container">
            <div class="navbar-brand">
                <div class="navbar-item"> GeoPush
                    </div>
            </div>
            @if(Auth::check())
            <div class="navbar-end">
                <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">{{ Auth::user()->name }}
                </a>
                <div class="navbar-dropdown">
                    <div class="navbar-item">
                        <a href="{{ Auth::logout() }}"> 
                            Logout

                        </a>
                    </div>
                </div>
                </div>
            </div>
            @endif
        </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
