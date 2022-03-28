@extends('master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <h3 class="text-center">
                    Úpraviť objednávku
                </h3>

                <div class="row align-items-center my-5">
                    <div class="col-md-6 d-flex justify-content-center">
                        <time datetime="{{ \Carbon\Carbon::parse($order->date)->format('Y-m-d') }}" class="icon">
                            <em>{{\Carbon\Carbon::parse($order->date)->isoFormat('dddd') }}</em>
                            <strong>{{\Carbon\Carbon::parse($order->date)->isoFormat('MMMM') }}</strong>
                            <span>{{\Carbon\Carbon::parse($order->date)->isoFormat('D') }}</span>
                        </time>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center my-3">
                        <h4>{{ $order->product->title ?? new Illuminate\Support\HtmlString("<span class=\"text-danger\">Tento produkt bol zmazaný!</span>") }}</h4>
                    </div>
                </div>

                <form class="row g-3" action="{{ route('orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="col-md-12">
                        <label for="select_children" class="form-label">Vyberte dieťa</label>
                        <select class="form-select" id="select_children" name="child_id">
                            @foreach ($childrens as $children)
                                <option value="{{ $children->id }}">{{ $children->name }} {{ $children->class }} {{ $children->address }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-success" onclick="this.disabled=true;this.innerText='Ukladá sa, počkajte prosím...';this.form.submit();">Uložiť</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
