@extends('admin.master')

@section('errors')
    @include('layouts.errors')
@endsection

@section('content')
    <h4 class="text-center">Produkty</h4>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">

                @forelse ($products as $product)
                    <div class="col-md-6 my-4">
                        <div class="dropdown d-flex justify-content-end">
                            <button class="ellipsis btn shadow-none" type="button" id="dropdownB-{{ $product->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownB-{{ $product->id }}">
                                <li><a class="dropdown-item" href="{{ route('products.edit', $product->id) }}">Upraviť</a></li>
                                <li><a class="dropdown-item" href="{{ route('products.show', $product->id) }}">Vymazať</a></li>
                                <li>
                                    <form method="POST" action="{{ route('products.archive', $product->id) }}" class="my-0">
                                        @csrf
                                        @method('PUT')

                                        <input type="hidden" name="status" value="1">
                                        <a class="dropdown-item" href="{{ route('products.archive', $product->id) }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                            Archivovať
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <div class="card shadow-lg h-100 my-1">
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
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>
                        Nenašli sa žiadne produkty.
                    </p>
                @endforelse

            </div>
        </div>
    </div>

@endsection
