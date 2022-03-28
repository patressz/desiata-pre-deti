@extends('master')

@section('errors')
    @include('layouts.errors')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">

                <h3 class="text-center">
                    Dobiť kredit
                </h3>

                <form action="{{ route('payment.add.credit') }}" method="POST">
                    @csrf

                    <div class="input-group mb-3">
                        <span class="input-group-text">&euro;</span>
                        <input type="number" class="form-control" aria-label="Amount" placeholder="Suma v eur" name="amount" step="0.5">
                        @error('amount')
                            <div class="invalid-feedback d-inline-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Dobiť kredit</button>
                </form>

            </div>
        </div>
    </div>
@endsection
