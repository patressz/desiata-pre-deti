@extends('master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h3 class="text-center">
                    Výberte dátum
                </h3>

                @foreach ($week_days as $key => $week_day)

                    @if ( $key == "Sobota" || $key == "Nedeľa" )
                        @continue
                    @endif

                    @if ( $week_day->gt( $today ) && $week_day->ne( $today ) && Carbon\Carbon::tomorrow()->ne( $week_day ) )

                        @if ( $today == Carbon\Carbon::parse('sunday') && $key == "Pondelok" && $now->gt( $twooclock ) )
                            <div class="card my-3">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-6 col">
                                            <time datetime="{{ $week_day->format('Y-m-d') }}" class="icon">
                                                <em>{{ $week_day->isoFormat('dddd') }}</em>
                                                <strong>{{ $week_day->isoFormat('MMMM') }}</strong>
                                                <span>{{ $week_day->isoFormat('D') }}</span>
                                            </time>
                                        </div>
                                        <div class="col-md-6 col d-flex justify-content-end">
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Na tento deň nie je možné zrealizovať objednávku!">
                                                <button class="btn btn-danger" disabled>Nedostupné</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @continue
                        @endif

                        <div class="card my-3 hover-bg">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-6 col">
                                        <time datetime="{{ $week_day->format('Y-m-d') }}" class="icon">
                                            <em>{{ $week_day->isoFormat('dddd') }}</em>
                                            <strong>{{ $week_day->isoFormat('MMMM') }}</strong>
                                            <span>{{ $week_day->isoFormat('D') }}</span>
                                        </time>
                                    </div>
                                    <div class="col-md-6 col d-flex justify-content-end">
                                        <form action="{{ route('orders.create') }}" method="GET">
                                            <input type="hidden" name="product_id" value="{{ request()->product_id }}">
                                            <input type="hidden" name="date" value="{{ $week_day->format('Y-m-d') }}">
                                            <button type="submit" class="btn btn-secondary">Objednať</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @elseif( Carbon\Carbon::tomorrow()->eq( $week_day ) && $now->lt( $twooclock ) )

                        @if ( $today == Carbon\Carbon::parse('sunday') && $key == "Pondelok" && $now->gt( $twooclock ) )
                            <div class="card my-3">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-6 col">
                                            <time datetime="{{ $week_day->format('Y-m-d') }}" class="icon">
                                                <em>{{ $week_day->isoFormat('dddd') }}</em>
                                                <strong>{{ $week_day->isoFormat('MMMM') }}</strong>
                                                <span>{{ $week_day->isoFormat('D') }}</span>
                                            </time>
                                        </div>
                                        <div class="col-md-6 col d-flex justify-content-end">
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Na tento deň nie je možné zrealizovať objednávku!">
                                                <button class="btn btn-danger" disabled>Nedostupné</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @continue
                        @endif

                        <div class="card my-3 hover-bg">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-6 col">
                                        <time datetime="{{ $week_day->format('Y-m-d') }}" class="icon">
                                            <em>{{ $week_day->isoFormat('dddd') }}</em>
                                            <strong>{{ $week_day->isoFormat('MMMM') }}</strong>
                                            <span>{{ $week_day->isoFormat('D') }}</span>
                                        </time>
                                    </div>
                                    <div class="col-md-6 col d-flex justify-content-end">
                                        <form action="{{ route('orders.create') }}" method="GET">
                                            <input type="hidden" name="date" value="{{ $week_day }}">
                                            <input type="hidden" name="product_id" value="{{ request()->product_id }}">
                                            <button type="submit" class="btn btn-secondary">Objednať</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else

                        <div class="card my-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-6 col">
                                        <time datetime="{{ $week_day->format('Y-m-d') }}" class="icon">
                                            <em>{{ $week_day->isoFormat('dddd') }}</em>
                                            <strong>{{ $week_day->isoFormat('MMMM') }}</strong>
                                            <span>{{ $week_day->isoFormat('D') }}</span>
                                        </time>
                                    </div>
                                    <div class="col-md-6 col d-flex justify-content-end">
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Na tento deň nie je možné zrealizovať objednávku!">
                                            <button class="btn btn-danger" disabled>Nedostupné</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endif

                @endforeach

            </div>
        </div>
    </div>
@endsection
