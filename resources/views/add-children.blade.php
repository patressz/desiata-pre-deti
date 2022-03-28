@extends('master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h3 class="text-center">
                    Pridať dieťa
                </h3>

                <form class="row g-3" action="{{ route('childrens.store') }}" method="POST">
                    @csrf

                    <div class="col-md-6">
                        <label for="name" class="form-label">Meno</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>

                    <div class="col-md-6">
                        <label for="class" class="form-label">Trieda</label>
                        <input type="text" class="form-control" id="class" name="class">
                    </div>

                    <div class="col-12">
                        <label for="school" class="form-label">Škola</label>
                        <select class="form-select" class="form-control" id="school" name="school">
                            @foreach ($schools as $school)
                                <option value="{{ $school->title }}">{{ $school->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.innerText='Ukladá sa, počkajte prosím...';this.form.submit();">Pridať</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
