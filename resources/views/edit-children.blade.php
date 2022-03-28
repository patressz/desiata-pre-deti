@extends('master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h3 class="text-center">
                    Upraviť dieťa
                </h3>

                <form class="row g-3" action="{{ route('childrens.update', $children->id) }}" method="POST" id="store_children">
                    @csrf
                    @method('PUT')

                    <div class="col-md-6">
                        <label for="name" class="form-label">Meno</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $children->name }}">
                        @error('name')
                            <div class="invalid-feedback d-inline-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="class" class="form-label">Trieda</label>
                        <input type="text" class="form-control" id="class" name="class" value="{{ $children->class }}">
                        @error('class')
                            <div class="invalid-feedback d-inline-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="school" class="form-label">Škola</label>
                        <select class="form-select" class="form-control" id="school" name="school">
                            @foreach ($schools as $school)
                                <option value="{{ $school->title }}" {{ $children->school == $school->title ?  "selected" : "" }}>{{ $school->title }}</option>
                            @endforeach
                        </select>
                        @error('school')
                            <div class="invalid-feedback d-inline-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-success" onclick="this.disabled=true;this.innerText='Ukladá sa, počkajte prosím...';this.form.submit();">Uložiť</button>
                        <button type="button" class="btn btn-link" onclick="window.location.href='{{ route('childrens.index') }}'">Zrušiť</button>
                    </div>
                  </form>

            </div>
        </div>
    </div>
@endsection
