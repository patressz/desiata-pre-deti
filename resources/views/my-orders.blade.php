@extends('master')

@section('errors')
    @include('layouts.errors')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                @if ( Carbon\Carbon::tomorrow()->eq( $date ) )
                    @include('layouts.deadline-warning')
                @endif

                <h3 class="text-center">
                    Moje objednávky
                </h3>


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
                    </div>

                </div>

                <div class="accordion">
                    @forelse ($orders as $product => $orders)

                        <div class="accordion-item">

                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-{{ $orders[0]->id }}" aria-expanded="true" aria-controls="panelsStayOpen-{{ $orders[0]->id }}">
                                    {{ $orders[0]->product->title ?? new Illuminate\Support\HtmlString("<span class=\"text-danger\">Tento produkt bol zmazaný!</span>") }}
                                </button>
                            </h2>
                            <div id="panelsStayOpen-{{ $orders[0]->id }}" class="accordion-collapse show">
                                <div class="accordion-body">

                                    <div class="table-responsive">
                                        <table class="table align-middle">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Meno dieťaťa</th>
                                                    <th scope="col">Škola</th>
                                                    <th scope="col">Trieda</th>
                                                    <th scope="col">Cena</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Akcia</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $key => $order)
                                                @php
                                                    $key++;
                                                @endphp
                                                    <tr>
                                                        <th scope="row">{{ $key }}</th>
                                                        <td>{{ $order->child->name }}</td>
                                                        <td>{{ $order->child->school }}</td>
                                                        <td>{{ $order->child->class }}</td>
                                                        <td>{{ $order->product->price ?? "?" }} &euro;</td>
                                                        <td>
                                                            @if ( $order->status == 0 )
                                                                <span class="badge bg-danger">Nedodaná</span>
                                                            @elseif ( $order->status == 1 )
                                                                <span class="badge bg-success">Doručená</span>
                                                            @endif
                                                        </td>
                                                        <td>

                                                            @if ($today == Carbon\Carbon::parse('sunday') && Carbon\Carbon::parse($order->date)->format('Y-m-d H:i:s') == $week_days['Pondelok'] && $now->gt( $twooclock ))
                                                                <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Počas uzavierky nie je možné aktualizovať objednávku!">
                                                                    <button class="btn btn-warning mt-1" disabled><i class="bi bi-pencil-fill"></i></button>
                                                                </span>
                                                                <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Počas uzavierky nie je možné stornovať objednávku!">
                                                                    <button class="btn btn-danger mt-1" disabled><i class="bi bi-trash"></i></button>
                                                                </span>
                                                                @continue
                                                            @endif

                                                            @if ( $order->status == 1 )
                                                                <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Objednávku so statusom 'dodaná' nie je možné aktualizovať!">
                                                                    <button class="btn btn-warning mt-1" disabled><i class="bi bi-pencil-fill"></i></button>
                                                                </span>
                                                                <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Objednávku so statusom 'doručená' nie je možné stornovať!">
                                                                    <button class="btn btn-danger mt-1" disabled><i class="bi bi-trash"></i></button>
                                                                </span>
                                                            @else
                                                                @if ( $today->lt( $date ) && $today->ne( $date ) && Carbon\Carbon::tomorrow()->ne( $date ) )
                                                                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning mt-1"><i class="bi bi-pencil-fill"></i></a>
                                                                    <form method="POST" action="{{ route('orders.destroy', $order->id) }}" class="d-inline-block">
                                                                        @csrf
                                                                        @method('DELETE')

                                                                        <a href="{{ route('orders.destroy', $order->id) }}" class="btn btn-danger mt-1 order-destroy"><i class="bi bi-trash"></i></a>
                                                                    </form>
                                                                @elseif ( Carbon\Carbon::tomorrow()->eq( $date ) && $now->lt( $twooclock ) )
                                                                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning mt-1"><i class="bi bi-pencil-fill"></i></a>
                                                                    <form method="POST" action="{{ route('orders.destroy', $order->id) }}" class="d-inline-block">
                                                                        @csrf
                                                                        @method('DELETE')

                                                                        <a href="{{ route('orders.destroy', $order->id) }}" class="btn btn-danger mt-1 order-destroy"><i class="bi bi-trash"></i></a>
                                                                    </form>
                                                                @elseif ( Carbon\Carbon::tomorrow()->eq( $date ) && $now->gt( $twooclock ) )
                                                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Počas uzavierky nie je možné aktualizovať objednávku!">
                                                                        <button class="btn btn-warning mt-1" disabled><i class="bi bi-pencil-fill"></i></button>
                                                                    </span>
                                                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Počas uzavierky nie je možné stornovať objednávku!">
                                                                        <button class="btn btn-danger mt-1" disabled><i class="bi bi-trash"></i></button>
                                                                    </span>
                                                                @elseif ( $today->ne( $date ) && $today->gt( $date ) )
                                                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Objednávku je možné aktualizovať deň vopred do {{ $twooclock->format('H:i') }} hodiny od dátumu objednania!">
                                                                        <button class="btn btn-warning mt-1" disabled><i class="bi bi-pencil-fill"></i></button>
                                                                    </span>
                                                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Objednávku je možné stornovať deň vopred do {{ $twooclock->format('H:i') }} hodiny od dátumu objednania!">
                                                                        <button class="btn btn-danger mt-1" disabled><i class="bi bi-trash"></i></button>
                                                                    </span>
                                                                @elseif ( $today->eq( $date ) )
                                                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Objednávku je možné aktualizovať deň vopred do {{ $twooclock->format('H:i') }} hodiny od dátumu objednania!">
                                                                        <button class="btn btn-warning mt-1" disabled><i class="bi bi-pencil-fill"></i></button>
                                                                    </span>
                                                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Objednávku je možné stornovať deň vopred do {{ $twooclock->format('H:i') }} hodiny od dátumu objednania!">
                                                                        <button class="btn btn-danger mt-1" disabled><i class="bi bi-trash"></i></button>
                                                                    </span>
                                                                @endif
                                                            @endif

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                        </div>
                    @empty
                        <p>
                            Na tento deň nemáte žiadnu objednávku.
                        </p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#select_date').change( function() {
            window.location.href="{{ url('my-orders/') }}" + "/" +this.value;
        });
    </script>
@endsection


