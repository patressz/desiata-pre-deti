@extends('admin.master')

@section('content')
    <h4 class="text-center">Alergény</h4>

    <div class="row justify-content-center">
        <div class="col-md-6">

            <table class="table-responsive table align-middle">
                <thead>
                    <tr>
                        <th scope="col">Alergén</th>
                        <th scope="col">Upraviť</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($allergens as $key => $allergen)
                        <tr>
                            <td>{{ $allergen->allergen_id . " " . $allergen->allergen }}</td>
                            <td>
                                <a href="{{ route('allergens.edit', $allergen->id) }}" class="btn btn-warning mt-1"><i class="bi bi-pencil-fill"></i></a>
                                <form method="POST" action="{{ route('allergens.destroy', $allergen->id) }}" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('allergens.destroy', $allergen->id) }}" class="btn btn-danger mt-1 allergen-destroy"><i class="bi bi-trash"></i></a>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">Nemáte pridaný žiadny alergén.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

@endsection
