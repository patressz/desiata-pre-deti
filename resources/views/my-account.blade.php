@extends('master')

@section('errors')
    @include('layouts.errors')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <h3 class="text-center">
                    Nastavenia
                </h3>

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Môj profil</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Zmena hesla</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active mt-5" id="home" role="tabpanel" aria-labelledby="home-tab">

                        <form class="row g-3" action="{{ route('my-account.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="col-md-12">
                                <label for="name" class="form-label">Meno a priezvisko</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" autofocus>
                                @error('name')
                                    <div class="invalid-feedback d-inline-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                @error('email')
                                    <div class="invalid-feedback d-inline-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-success" onclick="this.disabled=true;this.innerText='Ukladá sa, počkajte prosím...';this.form.submit();">Uložiť profil</button>
                            </div>
                        </form>

                    </div>

                    <div class="tab-pane fade mt-5" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                        <form class="row g-3" action="{{ route('my-account.update-password', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="col-md-12">
                                <label for="old_password" class="form-label">Súčasné heslo</label>
                                <input type="password" class="form-control" id="old_password" name="old_password">
                                @error('old_password')
                                    <div class="invalid-feedback d-inline-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="new_password" class="form-label">Nové heslo</label>
                                <input type="password" class="form-control" id="new_password" name="new_password">
                                @error('new_password')
                                    <div class="invalid-feedback d-inline-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="col-12">
                                <button type="submit" class="btn btn-success" onclick="this.disabled=true;this.innerText='Ukladá sa, počkajte prosím...';this.form.submit();">Uložiť</button>
                            </div>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
