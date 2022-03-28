@extends('admin.master')

@section('content')
    <h4 class="text-center">Nástenka</h4>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="row text-center">

                <div class="col-sm-6 mb-4">
                    <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Celkový počet objednávok</h5>
                        <p class="card-text h1">{{ $orders }}</p>
                    </div>
                    </div>
                </div>

                <div class="col-sm-6 mb-4">
                    <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Celkový počet produktov</h5>
                        <p class="card-text h1">{{ $products }}</p>
                    </div>
                    </div>
                </div>

                <div class="col-sm-6 mb-4">
                    <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Celkový počet používateľov</h5>
                        <p class="card-text h1">{{ $users }}</p>
                    </div>
                    </div>
                </div>

                <div class="col-sm-6 mb-4">
                    <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Celkový počet deti</h5>
                        <p class="card-text h1">{{ $childrens }}</p>
                    </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
