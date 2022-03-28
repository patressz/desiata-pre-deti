@extends('master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">

                <h3 class="text-center">
                    Prihlásiť sa
                </h3>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback d-inline-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Heslo</label>
                        <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" required>
                        @error('password')
                            <div class="invalid-feedback d-inline-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <label for="remember_me" class="form-check-label">
                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                            Pamätať si prihlásenie
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary">Prihlásiť sa</button>


                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            Zabudol som heslo
                        </a>
                    @endif

                    <div class="mt-5 text-center">
                        @if (Route::has('register'))
                        <p>
                            Nemáš účet? <a href="{{ route('register') }}">Zaregistruj sa</a>
                        </p>
                        @endif
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
