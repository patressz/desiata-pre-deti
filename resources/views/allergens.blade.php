@extends('master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <h3 class="text-center">
                    Zoznam alergénov
                </h3>

                <p>
                    @foreach ($allergens as $allergen)
                        {{ $allergen->allergen_id . " " . $allergen->allergen }} <br>
                    @endforeach
                </p>

            </div>
        </div>
    </div>
@endsection
