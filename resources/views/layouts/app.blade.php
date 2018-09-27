<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KZ/THERMO4U</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light navbar-branding bg-light">
        <a href="http://www.koogzaandijk.nl" target="_blank">
            <img src="http://www.koogzaandijk.nl/assets/default/image/logo_kzthermo4u_portrait.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-4">
                <li class="nav-item">
                    <a class="nav-link{{ true === Request::is('/') ? ' active' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ true === Request::is('members/create') ? ' active' : '' }}" href="/members/create/">Nieuw lid</a>
                </li>
            </ul>
        </div>
    </nav>
        @yield('content')
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
