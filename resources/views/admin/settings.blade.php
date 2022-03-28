@extends('admin.master')

@section('errors')
    @include('layouts.errors')
@endsection

@section('content')
    <h4 class="text-center">Nastavenia</h4>

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="table-responsive">
                <table class="table align-middle ">
                    <thead>
                        <tr>
                            <th scope="col">Názov</th>
                            <th scope="col">Status</th>
                            <th scope="col">Akcia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Registrácia</td>

                            @if ( $registration->value == 0 )
                                <td class="text-danger font-weight-bold">Zakázaná</td>
                            @else
                                <td class="text-success font-weight-bold">Povolená</td>
                            @endif

                            @if ( $registration->value == 0 )
                                <td>
                                    <form action="{{ route('update.registration') }}" method="POST" class="my-0">
                                        @csrf
                                        @method('put')

                                        <input type="hidden" name="status" value="1">
                                        <button type="button" class="btn btn-success btn-sm" onclick="this.disabled=true;this.innerText='Ukladá sa, počkajte prosím...';this.form.submit();">Povoliť</button>
                                    </form>
                                </td>
                            @else
                                <td>
                                    <form action="{{ route('update.registration') }}" method="POST" class="my-0">
                                        @csrf
                                        @method('put')

                                        <input type="hidden" name="status" value="0">
                                        <button type="button" class="btn btn-danger btn-sm" onclick="this.disabled=true;this.innerText='Ukladá sa, počkajte prosím...';this.form.submit();">Zakázať</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                        <tr>
                            <td>Uzavierka</td>
                            <td>
                                <form action="{{ route('update.deadline') }}" method="POST" class="my-0" id="update_deadline">
                                    @csrf
                                    @method('put')

                                    <input type="time" class="form-control" step="2" name="time" value="{{ $deadline->value }}">
                                </form>
                            </td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" onclick="this.disabled=true;this.innerText='Ukladá sa, počkajte prosím...';$('#update_deadline').submit();">Uložiť</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
