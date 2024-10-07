<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="PME" content="Blade">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Hello PME</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <!-- load bootstrap from a cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css">
    <!-- define carbon locale language -->
    <?php
    setlocale(LC_TIME, 'fr_FR');
    ?>
</head>

<body>
<div class="">
    <header>
    <nav class="navbar navbar-expand-lg navbar-light navbar-modife bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="{{asset('img/logo.svg')}}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <!-- <li class="nav-item {{ request()->route('home') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('accueil') }}">Accueil</a>
                    </li> -->
                      <!-- Menu déroulant -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Accueil
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="accueil">Presentation</a>
                            <a class="dropdown-item" href="accueil#typeFinacement">Types de financement</a>
                            <a class="dropdown-item" href="accueil#Opportunites_par_pays">Opportunités par pays</a>
                            <a class="dropdown-item" href="accueil#a_propos">A propos de Nous</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Nous contacter</a>
                        </div>
                    </li>
                    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home') }}">Appels d'Offres</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('home.financements') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home.financements') }}">Financements</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('home.evenements') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home.evenements') }}">Evénements</a>
                    </li>
                    {{--
                        <li class="nav-item">
                        <a class="nav-link" href="#">Experts</a>
                    </li>
                    --}}
                </ul>
                <ul class="navbar-nav ml-auto align-items-center">
                    <li class="nav-item">
                        <button class="btn btn-search">
                            <img src="{{asset('img/search.svg')}}" alt="">
                        </button>
                    </li>
                    <li class="nav-item">
                        <div class="lngg">
                        <select class="selectpicker" data-width="fit">
                            <option value="fr" {{ session('locale') === 'fr' ? 'selected' : '' }} data-content='<span class="flag-icon flag-icon-fr"></span> FR'>FR</option>
                            <option value="en" {{ session('locale') === 'en' ? 'selected' : '' }} data-content='<span class="flag-icon flag-icon-gb"></span> EN'>EN</option>
                        </select>
                        </div>
                    </li>
                    @guest
                    <li class="nav-item">
                        <a href="/login">
                            <button class="btn btn-Connexion">Connexion</button>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/register">
                            <button class="btn btn-inscription">Inscription</button>
                        </a>
                    </li>
                    @endguest
                    @auth
                    <li class="nav-item">
                        <a href="/profil">
                            <button class="btn btn-Connexion"><img width='50' src="{{ asset('/img/profile.png') }}" alt="" srcset=""></button>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-inscription">Déconnexion</button>
                        </form>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
</nav>

    </header>
