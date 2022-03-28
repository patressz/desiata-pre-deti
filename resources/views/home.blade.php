@extends('master')

@section('content')
    <div class="container col-md-12 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="{{ asset('assets/img/main.jpeg') }}" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold lh-1 mb-3">CHUTNÁ, ČERSTVÁ, BEZSTAROSTNÁ</h1>
                <p class="lead">Každá desiata obsahuje ovocie ako napríklad, jablko, hrušku, mandarinku, banán, hrozno, slivky a iné aj sezónne ovocie ktoré denne obmiename.</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <a href="{{ route('products') }}" class="btn btn-primary btn-lg px-4 me-md-2">PRODUKTY</a>
                    <a href="#products" class="btn btn-outline-secondary btn-lg px-4">VIAC INFO</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container col-md-12 px-4 py-5 text-center">
        <h1>
            Dôležitá informácia
        </h1>
       <p>
            Pre objednanie desiaty je potrebná spolupráca so školou. Aktuálne dodávame do týchto škôl:
       </p>
        @foreach ($schools as $school)
            <p>
                {{ $school->title }}
            </p>
        @endforeach
    </div>

    {{-- <div class="container px-4 py-5" id="featured-3">
    <h2 class="pb-2 border-bottom">Aká je naša desiata?</h2>
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">

            <div class="feature col">
                <div class="feature-icon bg-primary bg-gradient">
                    <svg class="bi" width="1em" height="1em"><use xlink:href="#collection"/></svg>
                </div>
                <h2>Chutná</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et quod neque quae ut quaerat, molestias iste minima debitis adipisci, ab cumque iure animi, aspernatur voluptas corporis harum non facere soluta.</p>
            </div>

            <div class="feature col">
                <div class="feature-icon bg-primary bg-gradient">
                    <svg class="bi" width="1em" height="1em"><use xlink:href="#people-circle"/></svg>
                </div>
                <h2>Čerstvá</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et quod neque quae ut quaerat, molestias iste minima debitis adipisci, ab cumque iure animi, aspernatur voluptas corporis harum non facere soluta.</p>
            </div>

            <div class="feature col">
                <div class="feature-icon bg-primary bg-gradient">
                    <svg class="bi" width="1em" height="1em"><use xlink:href="#toggles2"/></svg>
                </div>
                <h2>Bezstarostná</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et quod neque quae ut quaerat, molestias iste minima debitis adipisci, ab cumque iure animi, aspernatur voluptas corporis harum non facere soluta.</p>
            </div>

        </div>
    </div> --}}


    {{-- <div class="container px-4 py-5" id="custom-cards">
        <h2 class="pb-2 border-bottom">Custom cards</h2>

        <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
            <div class="col">
                <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url('{{ asset('assets/img/texture.png') }}');">
                    <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                        <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Text</h2>
                        <ul class="d-flex list-unstyled mt-auto">
                            <li class="me-auto">
                                <img src="https://github.com/twbs.png" alt="Bootstrap" width="32" height="32" class="rounded-circle border border-white">
                            </li>
                            <li class="d-flex align-items-center me-3">
                                <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#geo-fill"/></svg>
                            </li>
                            <li class="d-flex align-items-center">
                                <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#calendar3"/></svg>
                                <small>3d</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url('{{ asset('assets/img/texture.png') }}');">
                    <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                        <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Text</h2>
                        <ul class="d-flex list-unstyled mt-auto">
                            <li class="me-auto">
                                <img src="https://github.com/twbs.png" alt="Bootstrap" width="32" height="32" class="rounded-circle border border-white">
                            </li>
                            <li class="d-flex align-items-center me-3">
                                <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#geo-fill"/></svg>
                            </li>
                            <li class="d-flex align-items-center">
                                <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#calendar3"/></svg>
                                <small>4d</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url('{{ asset('assets/img/texture.png') }}');">
                    <div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1">
                        <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Text</h2>
                        <ul class="d-flex list-unstyled mt-auto">
                            <li class="me-auto">
                                <img src="https://github.com/twbs.png" alt="Bootstrap" width="32" height="32" class="rounded-circle border border-white">
                            </li>
                            <li class="d-flex align-items-center me-3">
                                <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#geo-fill"/></svg>
                            </li>
                            <li class="d-flex align-items-center">
                                <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#calendar3"/></svg>
                                <small>5d</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div> --}}

    <div class="container px-4 py-5 my-5" id="products">
        <div class="row justify-content-center">
            @forelse ($products as $product)
                <div class="col-md-3 my-3">
                    <div class="card shadow-lg h-100">
                        <img src="{{ asset('storage/image/' . $product->image ) }}" class="card-img-top" alt="{{ $product->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->title }}</h5>
                            <p class="card-text">{{ $product->about }}</p>
                            <p>
                                Alergény:
                                @foreach ($product->allergens as $allergen)
                                    {{ $allergen->allergen_id }}{{ $loop->remaining ? "," : "" }}
                                @endforeach
                            </p>
                            <ul class="d-flex list-unstyled mt-auto">
                                <li class="d-flex align-items-center fw-bold me-3">
                                    {{ $product->price }} &euro;
                                </li>
                                <li class="d-flex align-items-center fw-bold">
                                    <form action="{{ route('order.select.date') }}" method="GET">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="btn btn-primary">Objednať</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @empty
                <p>Nenašli sa žiadne produkty.</p>
            @endforelse
            <div class="col-md-12 text-center my-3">
                <a href="{{ route('products') }}" class="btn btn-primary btn-lg px-4 me-md-2">Celá ponuka</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading">SUPER DESIATA</h2>
                <p class="lead">Je jedinečný projekt zameraný na výrobu a distribúciu desiat do škôl. Je to moderný spôsob ako si z pohodlia svojho domova vybrať a objednať desiatu. A tak starosti ako nákupy, vymýšlanie a príprava, ktorá zaberie aj niekoľko hodín týždenne si skrátite len na niekoľko minút. Jednoduchou registráciou a pár klikmi si desiatu objednáte aj na celý týžden dopredu. Našim cielom je: Rodičov odbremeniť a ušetrit im čas a deťom prinášať denne chutnú, vyvaženú, ale hlavne čerstvú desiatu.</p>
                <p class="lead">Niektoré druhy desiat budeme obmieňať, ale aj pridávať nové aby ponuka bola pestrá. Samozrejme nápady a postrehy zo strany rodičov sú vítané. <a href="mailto:info@superdesiata.sk">info@superdesiata.sk</a></p>
            </div>
            <div class="col-md-5">
                <img src="{{ asset('assets/img/DSC_0072.JPG') }}" alt="" class="img-fluid mx-auto" width="500" height="500">
                {{-- <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg> --}}
            </div>
        </div>
    </div>

@endsection
