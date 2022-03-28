<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Superdesiata</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/cookie.css') }}">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('assets/img/logo.jpg') }}" alt="" width="80" height="120">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                        @if (Route::has('home'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->segment(1) == "" ? "active" : "" }}" aria-current="page" href="{{ route('home') }}">Domu</a>
                            </li>
                        @endif

                        @if (Route::has('products'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->segment(1) == "products" ? "active" : "" }}" href="{{ route('products') }}">Produkty</a>
                            </li>
                        @endif

                        @if (Route::has('allergens'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->segment(1) == "allergens" ? "active" : "" }}" href="{{ route('allergens') }}">Alergény</a>
                            </li>
                        @endif

                        @auth
                            @if (Route::has('orders.index'))
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->segment(1) == "my-orders" ? "active" : "" }}" href="{{ route('orders.index', now()->format('Y-m-d')) }}">Moje objednávky</a>
                                </li>
                            @endif
                        @endauth

                        @auth
                            @if (Route::has('childrens.index'))
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->segment(1) == "childrens" && request()->segment(2) == "" ? "active" : "" }}" href="{{ route('childrens.index') }}">Moje deti</a>
                                </li>
                            @endif

                            @can('view-dashboard')
                                @if (Route::has('admin.dashboard'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Nástenka</a>
                                    </li>
                                @endif
                            @endcan
                        @endauth

                    </ul>

                    @auth
                        <ul class="navbar-nav mb-2 mb-lg-0">

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('payment.home') }}"><span class="fw-bold">{{ Auth::user()->money }} &euro;</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('my-account.index') }}">Nastavenia</a>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Odhlásiť sa</a>
                                        </form>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    @endauth

                    @guest
                        <form class="d-flex">

                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Prihlásiť sa</a>
                            @endif

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary">Registrovať</a>
                            @endif

                        </form>
                    @endguest

                </div>

            </div>
          </nav>
    </div>
