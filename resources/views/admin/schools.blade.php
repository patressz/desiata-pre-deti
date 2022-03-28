@extends('admin.master')

@section('content')
    <h4 class="text-center">Zoznam škôl</h4>

    <div class="row justify-content-center">
        <div class="col-md-6">

            <table class="table-responsive table align-middle text-center">
                <thead>
                    <tr>
                        <th scope="col">Názov školy</th>
                        <th scope="col">Upraviť</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($schools as $school)
                        <tr>
                            <td>{{ $school->title }}</td>
                            <td>
                                <a href="{{ route('schools.edit', $school->id) }}" class="btn btn-warning mt-1"><i class="bi bi-pencil-fill"></i></a>
                                <form method="POST" action="{{ route('schools.destroy', $school->id) }}" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('schools.destroy', $school->id) }}" class="btn btn-danger mt-1 school-destroy"><i class="bi bi-trash"></i></a>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">Nemáte pridanú žiadnú školu.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

@endsection
