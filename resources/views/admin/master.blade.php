@include('admin.partials.header')

    @php
        use Jenssegers\Agent\Agent;
        $agent = new Agent();
    @endphp

    <body id="body-pd" {{ $agent->isDesktop() ? "class=body-pd" : ""}}>

        <header id="header" class="header {{ $agent->isDesktop() ? "body-pd" : ""}}">
            <div class="header_toggle"> <i class='{{ $agent->isDesktop() ? "bi bi-list bi-x" : "bi bi-list"}}' id="header-toggle"></i> </div>
            {{ Auth::user()->name }} | {{ Auth::user()->role->type }}
        </header>

        <div class="l-navbar {{ $agent->isDesktop() ? "show" : ""}}" id="nav-bar">
            <nav class="nav">

                <div>
                    <a href="{{ route('home') }}" class="nav_logo">
                        <i class='bi bi-house-door nav_logo-icon'></i> <span class="nav_logo-name">Domu</span>
                    </a>

                    <div class="nav_list">

                        <a href="{{ route('admin.dashboard') }}" class="nav_link">
                            <i class='bi bi-display nav_icon'></i><span class="nav_name {{ request()->segment(2) == "dashboard" ? "active" : "" }}">Nástenka</span>
                        </a>

                        <a href="{{ route('admin-orders.index', now()->format('Y-m-d')) }}" class="nav_link">
                            <i class='bi bi-cart3 nav_icon'></i><span class="nav_name {{ request()->segment(2) == "admin-orders" ? "active" : "" }}">Objednávky</span>
                        </a>

                        <a href="{{ route('payments', now()->format('Y-m-d')) }}" class="nav_link">
                            <i class="bi bi-credit-card"></i><span class="nav_name {{ request()->segment(2) == "payments" ? "active" : "" }}">Platby</span>
                        </a>

                        <a href="{{ route('products.index') }}" class="nav_link {{ request()->segment(2) == "products" && request()->segment(3) == "" ? "active" : "" }}">
                            <i class='bi bi-card-list nav_icon'></i><span class="nav_name">Produkty</span>
                        </a>

                        <a href="{{ route('products.archived') }}" class="nav_link {{ request()->segment(2) == "archived-products" ? "active" : "" }}">
                            <i class='bi bi-archive nav_icon'></i><span class="nav_name">Archivované produkty</span>
                        </a>

                        <a href="{{ route('products.create') }}" class="nav_link {{ request()->segment(2) == "products" && request()->segment(3) == "create" ? "active" : "" }}">
                            <i class='bi bi-plus-lg nav_icon'></i><span class="nav_name">Pridať nový produkt</span>
                        </a>

                        <a href="{{ route('allergens.index') }}" class="nav_link {{ request()->segment(2) == "allergens" && request()->segment(3) == "" ? "active" : "" }}">
                            <i class='bi bi-egg nav_icon'></i><span class="nav_name">Alergény</span>
                        </a>

                        <a href="{{ route('allergens.create') }}" class="nav_link {{ request()->segment(2) == "allergens" && request()->segment(3) == "create" ? "active" : "" }}">
                            <i class='bi bi-plus-lg nav_icon'></i><span class="nav_name">Pridať nový alergén</span>
                        </a>

                        <a href="{{ route('schools.index') }}" class="nav_link {{ request()->segment(2) == "schools" && request()->segment(3) == "" ? "active" : "" }}">
                            <i class='bi bi-building nav_icon'></i><span class="nav_name">Zoznam škôl</span>
                        </a>

                        <a href="{{ route('schools.create') }}" class="nav_link {{ request()->segment(2) == "schools" && request()->segment(3) == "create" ? "active" : "" }}">
                            <i class='bi bi-plus-lg nav_icon'></i><span class="nav_name">Pridať novú školu</span>
                        </a>

                        <a href="{{ route('users.index') }}" class="nav_link {{ request()->segment(2) == "users" ? "active" : "" }}">
                            <i class='bi bi-people nav_icon'></i><span class="nav_name">Používatelia</span>
                        </a>

                        <a href="{{ route('settings') }}" class="nav_link {{ request()->segment(2) == "settings" ? "active" : "" }}">
                            <i class='bi bi-gear nav_icon'></i><span class="nav_name">Nastavenia</span>
                        </a>

                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="my-0">
                    @csrf

                    <a href="{{ route('logout') }}" class="nav_link" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="bi bi-box-arrow-left nav_icon"></i><span class="nav_name">Odhlásiť sa</span>
                    </a>
                </form>

            </nav>
        </div>

        <!--Container Main start-->
        <div class="height-100 bg-light">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @include('layouts.messages')
                    @yield('errors')
                </div>
            </div>
            @yield('content')
        </div>
        <!--Container Main end-->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript" src="{{ asset('assets/js/sidebar.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/app.js') }}"></script>
        @livewireScripts
        @yield('scripts')
    </body>

@include('admin.partials.footer')

