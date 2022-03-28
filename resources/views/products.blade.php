@extends('master')

@section('errors')
    @include('layouts.errors')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <h3 class="text-center">
                    Ponuka desiat rožky
                </h3>

                <div class="row my-5">

                    @forelse ($bread_rolls as $product)
                        <div class="col-md-6 my-3">
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

                </div>

                <h3 class="text-center">
                    Celozrnné chlebíčky
                </h3>

                <div class="row my-5">

                    @forelse ($wholemeal_sandwiches as $product)
                        <div class="col-md-6 my-3">
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

                </div>

            </div>
        </div>
    </div>
@endsection
