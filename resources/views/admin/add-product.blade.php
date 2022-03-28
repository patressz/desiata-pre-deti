@extends('admin.master')

@section('content')
    <h4 class="text-center">Pridať nový produkt</h4>

    <div class="row justify-content-center">
        <div class="col-md-6">

            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="file" class="form-label">Obrázok</label>
                    <input class="form-control" type="file" id="file" name="image" accept="image/png, image/jpeg, image/gif">
                    @error('image')
                        <div class="invalid-feedback d-inline-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Názov</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                    @error('title')
                        <div class="invalid-feedback d-inline-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="about" class="form-label">Popis</label>
                    <textarea class="form-control" rows="3" name="about">{{ old('about') }}</textarea>
                    @error('about')
                        <div class="invalid-feedback d-inline-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Kategória</label>
                    <select class="form-select" name="category">
                        <option value="bread-rolls">Rožky</option>
                        <option value="wholemeal-sandwiches">Celozrnné chlebíčky</option>
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
                        <input type="numeric" class="form-control" id="price" name="price" value="{{ old('price') }}" placeholder="Suma v eur">
                    </div>
                    @error('price')
                        <div class="invalid-feedback d-inline-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <p>
                    Vyberte alergény
                </p>

                <div class="row">
                    @foreach ($allergens as $allergen)
                        <div class="col-md-6">
                            <div class="mb-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $allergen->id }}" name="allergens[]" id="{{ $allergen->id }}">
                                    <label class="form-check-label" for="{{ $allergen->id }}">
                                        {{ $allergen->allergen_id . " " . $allergen->allergen }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="button" class="btn btn-primary mt-3" onclick="this.disabled=true;this.innerText='Ukladá sa, počkajte prosím...';this.form.submit();">Pridať</button>

            </form>

        </div>
    </div>

@endsection
