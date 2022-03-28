<div>

    <div class="row">

        <div class="col-md-6 mt-2">
            <input wire:model="search" class="form-control" type="text" placeholder="Hľadať používateľa...">
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
                    <th scope="col">#</th>
                    <th scope="col">Meno používateľa</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Rola</th>
                    <th scope="col">Počet deti</th>
                    <th scope="col">Počet objednávok</th>
                    <th scope="col">Kredit</th>
                    <th scope="col">Akcia</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)

                    @if ($user->id == Auth::id())
                        @continue
                    @endif

                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->type }}</td>
                        <td>{{ $user->childrens->count() }}</td>
                        <td>{{ $user->orders->count() }}</td>
                        <td>{{ $user->money }} &euro;</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning mt-1"><i class="bi bi-pencil-fill"></i></a>
                            <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="d-inline-block">
                                @csrf
                                @method('DELETE')

                                <a href="{{ route('users.destroy', $user->id) }}" class="btn btn-danger mt-1 user-destroy"><i class="bi bi-trash"></i></a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $users->links() }}

</div>
