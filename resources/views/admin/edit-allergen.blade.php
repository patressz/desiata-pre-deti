@extends('admin.master')

@section('content')
    <h4 class="text-center">Upraviť alergén</h4>

    <div class="row justify-content-center">
        <div class="col-md-6">

            <form action="{{ route('allergens.update', $allergen->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <div class="row">

                        <div class="col-md-1">
                            <label for="allergen_id" class="form-label">#</label>
                            <input type="text" class="form-control" id="allergen_id" name="allergen_id" value="{{ $allergen->allergen_id }}" placeholder="3">
                            @error('allergen_id')
                                <div class="invalid-feedback d-inline-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-11">
                            <label for="allergen" class="form-label">Alergén</label>
                            <input type="text" class="form-control" id="allergen" name="allergen" value="{{ $allergen->allergen }}" placeholder="- vajcia a výrobky z nich">
                            @error('allergen')
                                <div class="invalid-feedback d-inline-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>
                </div>

                <button type="button" class="btn btn-success mt-3" onclick="this.disabled=true;this.innerText='Ukladá sa, počkajte prosím...';this.form.submit();">Uložiť</button>
                <button type="button" class="btn btn-link mt-3" onclick="window.location.href='{{ route('allergens.index') }}'">Zrušiť</button>

            </form>

        </div>
    </div>

@endsection
