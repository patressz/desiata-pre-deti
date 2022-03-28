<div>

    <div class="row">

        <div class="col-md-6 mt-2">
            <input wire:model="search" class="form-control" type="text" placeholder="Hľadať platbu...">
        </div>

        <div class="col-md-6 mt-2">
            <select wire:model="perPage" class="form-select">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope="col">ID objednávky</th>
                    <th scope="col">ID používateľa</th>
                    <th scope="col">Stripe ID</th>
                    <th scope="col">Meno používateľa</th>
                    <th scope="col">Čiastka</th>
                    <th scope="col">Dátum a čas</th>
                </tr>
            </thead>
            <tbody>
                    @forelse ($payments as $payment)
                        <tr>
                            <th scope="row">{{ $payment->id }}</th>
                            <th scope="row">{{ $payment->user_id }}</th>
                            <td>{{ $payment->stripe_id }}</td>
                            <td>{{ $payment->user_name }}</td>
                            <td>{{ $payment->amount }} &euro;</td>
                            <td>{{ $payment->created_at->format('d.m.Y H:i:s') }} </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="6">Nie sú evidované žiadne platby.</td>
                        </tr>
                    @endforelse
            </tbody>
        </table>
    </div>

    {{ $payments->links() }}

</div>
