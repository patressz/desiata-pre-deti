@extends('admin.master')

@section('content')
    <h4 class="text-center">Pridať nový alergén</h4>

    <div class="row justify-content-center">
        <div class="col-md-6">

            <form action="{{ route('allergens.store') }}" method="post">
                @csrf

                <div class="mb-3">
                    <div class="row">

                        <div class="col-md-1">
                            <label for="allergen_id" class="form-label">#</label>
                            <input type="text" class="form-control" id="allergen_id" name="allergen_id" value="{{ old('allergen_id') }}" placeholder="3">
                            @error('allergen_id')
                                <div class="invalid-feedback d-inline-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-11">
                            <label for="allergen" class="form-label">Alergén</label>
                            <input type="text" class="form-control" id="allergen" name="allergen" value="{{ old('allergen') }}" placeholder="- vajcia a výrobky z nich">
                            @error('allergen')
                                <div class="invalid-feedback d-inline-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>
                </div>

                <button type="button" class="btn btn-primary mt-3" onclick="this.disabled=true;this.innerText='Ukladá sa, počkajte prosím...';this.form.submit();">Pridať</button>

            </form>

        </div>
    </div>

@endsection
