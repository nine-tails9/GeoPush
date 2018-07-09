<html>
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

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
</head>
<body class="bg">
    <nav class="navbar is-light" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="https://cataliist.in">
                    <span class="icon">
                            <i class="fa fa-fire fa-lg"></i>
                    </span>
                    Geopush
                </a>
            </div>
            <div class="navbar-menu">
                <div class="navbar-end">
                    <a class="navbar-item" href="{{ route('login') }}">
                        Login
                    </a>
                    <div class="navbar-item">
                           <a class="button is-danger is-rounded" href="{{ route('register') }}"> Signup</a>
                    </div>
                </div>
            </div>
    </nav>
    <section class="section">
    
        <div class="columns is-centered">
        <div class="column is-half is-narrow" style="margin-left:15%;">
            <div class="typewriter">
                <h1 class="title has-text-grey">
                    Welcome to Geopush ))))
                </h1>
            </div>
        </div>
    </div>
    
    <div class="columns is-centered" style="margin-top:5%;">
        <div class="column">
            <div class="container has-text-centered">
                <div class="hold"> 
                <a href="{{ route('login') }}" class="button is-rounded is-medium is-info">
                        Get Started 
                </a>
                </div>
            </div>
        </div>
  
    </div>
    </section>

    <script src="{{ asset('js/custom.js') }}"></script>

</body>
</html>