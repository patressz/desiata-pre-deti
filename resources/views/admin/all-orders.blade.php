@extends('admin.master')

@section('errors')
    @include('layouts.errors')
@endsection

@section('content')
    <h4 class="text-center">Objednávky</h4>

    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="row align-items-center my-5">

                <div class="col-md-6 d-flex justify-content-center">
                    <time datetime="{{ \Carbon\Carbon::parse($date)->format('Y-m-d') }}" class="icon">
                        <em>{{\Carbon\Carbon::parse($date)->isoFormat('dddd') }}</em>
                        <strong>{{\Carbon\Carbon::parse($date)->isoFormat('MMMM') }}</strong>
                        <span>{{\Carbon\Carbon::parse($date)->isoFormat('D') }}</span>
                    </time>
                </div>

                <div class="col-md-6 my-3 d-flex justify-content-center">
                    <input type="date" class="form-control" id="select_date" value="{{ Carbon\Carbon::parse($date)->format('Y-m-d') }}">
                    <a href="{{ route('admin-orders.export', Carbon\Carbon::parse($date)->format('Y-m-d')) }}" class="btn btn-success btn-sm mx-2">Exportovať objednávky</a>
                </div>

            </div>

            @livewire('all-orders',['date' => $date])

        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $('#select_date').change( function() {
            window.location.href="{{ url('admin/admin-orders/') }}" + "/" +this.value;
        });
    </script>
@endsection
