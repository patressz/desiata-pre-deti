@extends('admin.master')

@section('content')
    <h4 class="text-center">Vymazať produkt</h4>

    <div class="row justify-content-center">
        <div class="col-md-6">

            <form action="{{ route('products.destroy', $product->id) }}" method="post">
                @csrf
                @method('DELETE')

                <div class="mb-3">
                    <label for="title" class="form-label">Názov</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $product->title }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="about" class="form-label">Popis</label>
                    <textarea class="form-control" id="about" rows="3" name="about" disabled>{{ $product->about }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Kategória</label>
                    <select class="form-select" name="category" disabled>
                        <option value="bread-rolls"{{ $product->category == "bread-rolls" ? "selected" : ""  }}>Rožky</option>
                        <option value="wholemeal-sandwiches"{{ $product->category == "wholemeal-sandwiches" ? "selected" : ""  }}>Celozrnné chlebíčky</option>
                    </select>
                    @error('category')
                        <div class="invalid-feedback d-inline-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Cena</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">€</span>
                        <input type="numeric" class="form-control" id="price" name="price" value="{{ $product->price }}" placeholder="Suma v eur" disabled>
                    </div>
                </div>

                <p>
                    Alergény:
                    @foreach ($product->allergens as $allergen)
                    {{ $allergen->allergen_id }}{{ $loop->remaining ? "," : "" }}
                @endforeach
                </p>

                <div class="row">
                    @foreach ($allergens as $key => $allergen)
                        <div class="col-md-6">
                            <div class="mb-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $key }}" name="allergens[]" id="{{ $key }}" disabled>
                                    <label class="form-check-label" for="{{ $key }}">
                                        {{ $key . " - " . $allergen }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="button" class="btn btn-danger mt-3 product-destroy">Vymazať</button>
                <button type="button" class="btn btn-link mt-3" onclick="window.location.href='{{ route('products.index') }}'">Zrušiť</button>

            </form>

        </div>
    </div>

@endsection
