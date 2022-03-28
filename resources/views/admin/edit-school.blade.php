@extends('admin.master')

@section('content')
    <h4 class="text-center">Upraviť školu</h4>

    <div class="row justify-content-center">
        <div class="col-md-6">

            <form action="{{ route('schools.update', $school->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <div class="row">

                        <div class="col-md-12">
                            <label for="title" class="form-label">Názov školy</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $school->title }}">
                            @error('title')
                                <div class="invalid-feedback d-inline-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>
                </div>

                <button type="button" class="btn btn-success mt-3" onclick="this.disabled=true;this.innerText='Ukladá sa, počkajte prosím...';this.form.submit();">Uložiť</button>
                <button type="button" class="btn btn-link mt-3" onclick="window.location.href='{{ route('schools.index') }}'">Zrušiť</button>

            </form>

        </div>
    </div>

@endsection
