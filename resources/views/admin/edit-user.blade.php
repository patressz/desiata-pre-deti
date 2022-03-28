@extends('admin.master')

@section('content')
    <h4 class="text-center">Upraviť používateľa</h4>

    <div class="row justify-content-center">
        <div class="col-md-8">

            <form action="{{ route('users.update', $user->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="row justify-content-center">

                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="name" class="form-label">Meno</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                            @error('name')
                                <div class="invalid-feedback d-inline-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                            @error('email')
                                <div class="invalid-feedback d-inline-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="credit" class="form-label">Kredit</label>
                            <input type="number" class="form-control" id="credit" name="credit" value="{{ $user->money }}">
                            @error('credit')
                                <div class="invalid-feedback d-inline-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    @if ( auth()->user()->role->id == 3 )
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="role" class="form-label">Rola</label>
                                <select class="form-select" id="role" name="role">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{$user->role->id == $role->id ? "selected" : "" }}>{{ $role->type }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <div class="invalid-feedback d-inline-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    @endif

                    <div class="col-md-8">
                        <button type="button" class="btn btn-success mt-3" onclick="this.disabled=true;this.innerText='Ukladá sa, počkajte prosím...';this.form.submit();">Uložiť</button>
                        <button type="button" class="btn btn-link mt-3" onclick="window.location.href='{{ route('users.index') }}'">Zrušiť</button>
                        <button type="button" class="btn btn-warning generate-password mt-3">Vygenerovať nové heslo</button>
                    </div>
                </div>

            </form>

            <form action="{{ route('users.generate.new.password', $user->id) }}" method="POST" id="generate_new_password">
                @csrf
                @method('PUT')
            </form>

        </div>
    </div>

@endsection
