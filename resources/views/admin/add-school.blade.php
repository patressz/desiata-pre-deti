@extends('admin.master')

@section('content')
    <h4 class="text-center">Pridať novú školu</h4>

    <div class="row justify-content-center">
        <div class="col-md-6">

            <form action="{{ route('schools.store') }}" method="post">
                @csrf

                <div class="mb-3">
                    <div class="row">

                        <div class="col-md-12">
                            <label for="title" class="form-label">Názov školy</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                            @error('title')
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
