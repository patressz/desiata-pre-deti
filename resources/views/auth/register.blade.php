@extends('master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">

                <h3 class="text-center">
                    Registrácia
                </h3>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Meno</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <div class="invalid-feedback d-inline-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback d-inline-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Heslo</label>
                        <input type="password" class="form-control" id="password" name="password" required autocomplete="new-password">
                        @error('password')
                            <div class="invalid-feedback d-inline-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Potvrďte heslo</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        @error('password')
                            <div class="invalid-feedback d-inline-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Zaregistrovať sa</button>

                    <div class="mt-5 text-center">
                        @if (Route::has('register'))
                        <p>
                            Máš účet? <a href="{{ route('login') }}">Prihlás sa</a>
                        </p>
                        @endif
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
