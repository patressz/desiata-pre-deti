@foreach ($orders as $product => $orders)

    <table>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Meno dieťaťa</th>
                <th scope="col">Škola</th>
                <th scope="col">Trieda</th>
                <th scope="col">Produkt</th>
                <th scope="col">Cena</th>
                <th scope="col">Dátum</th>
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
                    <td>{{ $order->product->title ?? new Illuminate\Support\HtmlString("<span class=\"text-danger\">Tento produkt bol zmazaný!</span>")}}</td>
                    <td>{{ $order->product->price ?? "?"}} &euro;</td>
                    <td>{{ Carbon\Carbon::parse($order->date)->format('d.m.Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endforeach
