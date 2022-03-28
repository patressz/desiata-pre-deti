<div>

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
                                                    <div class="dropdown">
                                                        <button class="btn btn-danger btn-sm dropdown-toggle" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Nedodaná
                                                        </button>

                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <li><button wire:click="update_status({{ $order->id }})" class="dropdown-item">Doručená</button></li>
                                                        </ul>
                                                    </div>
                                                @elseif ( $order->status == 1 )
                                                    <div class="dropdown">
                                                        <button class="btn btn-success btn-sm dropdown-toggle" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Doručená
                                                        </button>

                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <li><button wire:click="update_status({{ $order->id }})" class="dropdown-item">Nedodaná</button></li>
                                                        </ul>
                                                    </div>
                                                @endif
                                            <td>
                                                <form method="POST" action="{{ route('admin-orders.destroy', $order->id) }}" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')

                                                    <a href="{{ route('orders.destroy', $order->id) }}" class="btn btn-danger  mt-1 admin-order-destroy"><i class="bi bi-trash"></i></a>
                                                </form>
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
                Na tento deň nie je evidovaná žiadna objednávka.
            </p>
        @endforelse
    </div>

</div>
