@extends('master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <h3 class="text-center">
                    Vyberte dieťa
                </h3>

                <div class="row align-items-center my-5">
                    <div class="col-md-6 d-flex justify-content-center">
                        <time datetime="{{ \Carbon\Carbon::parse(request()->date)->format('Y-m-d') }}" class="icon">
                            <em>{{\Carbon\Carbon::parse(request()->date)->isoFormat('dddd') }}</em>
                            <strong>{{\Carbon\Carbon::parse(request()->date)->isoFormat('MMMM') }}</strong>
                            <span>{{\Carbon\Carbon::parse(request()->date)->isoFormat('D') }}</span>
                        </time>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center my-3">
                        <h4>{{ $product->title }} <strong>{{ $product->price }} &euro;</strong></h4>
                    </div>
                </div>

                <form class="row g-3" action="{{ route('orders.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ request()->product_id }}">
                    <input type="hidden" name="date" value="{{ request()->date }}">

                    <div class="col-md-12">
                        <label for="select_children" class="form-label">Vyberte dieťa</label>
                        <select class="form-select" id="select_children" name="child_id">
                            @foreach ($childrens as $children)
                                <option value="{{ $children->id }}">{{ $children->name }} {{ $children->class }} {{ $children->school }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h6>
                                    Celková suma objednávky: {{ $product->price }} &euro;
                                </h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.innerText='Odosiela sa, počkajte prosím...';this.form.submit();">Odoslať objednávku</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
