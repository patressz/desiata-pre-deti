@extends('admin.master')

@section('errors')
    @include('layouts.errors')
@endsection

@section('content')
    <h4 class="text-center">Používatelia</h4>

    <div class="row justify-content-center">
        <div class="col-md-8">

            @livewire('users')

        </div>
    </div>

@endsection
