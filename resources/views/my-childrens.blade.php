@extends('master')

@section('errors')
    @include('layouts.errors')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h3 class="text-center">
                    Moje deti
                </h3>

                <div class="row my-5">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create_children">Pridať dieťa</button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Meno dieťaťa</th>
                                <th scope="col">Škola</th>
                                <th scope="col">Trieda</th>
                                <th scope="col">Akcia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($childrens as $key => $child)
                                @php
                                    $key++;
                                @endphp

                                <tr>
                                    <th scope="row">{{ $key }}</th>
                                    <td>{{ $child->name }}</td>
                                    <td>{{ $child->school }}</td>
                                    <td>{{ $child->class }}</td>
                                    @if ( empty(App\Models\Order::where('child_id', $child->id)->where('status', 0)->count()) )
                                        <td>
                                            <a href="{{ route('childrens.edit', $child->id) }}" class="btn btn-warning mt-1"><i class="bi bi-pencil-fill"></i></a>
                                            <form method="POST" action="{{ route('childrens.destroy', $child->id) }}" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')

                                                <a href="{{ route('childrens.destroy', $child->id) }}" class="btn btn-danger mt-1 children-destroy"><i class="bi bi-trash"></i></a>
                                            </form>
                                        </td>
                                    @else
                                        <td>
                                            <a href="{{ route('childrens.edit', $child->id) }}" class="btn btn-warning mt-1"><i class="bi bi-pencil-fill"></i></a>
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" title="Dieťa nie je možné odstrániť ak nejaká z objednávok patriaca tomúto dieťaťu má status 'nedodaná'">
                                                <button class="btn btn-danger mt-1" disabled><i class="bi bi-trash"></i></button>
                                            </span>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Nemáte pridané žiadne dieťa.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        @include('layouts.add-children-modal')

    </div>

@endsection

@section('scripts')
    <script>
        @if ( session('errors') )
            @if ( session('errors')->has('name') || session('errors')->has('class') || session('errors')->has('school') )
                $( document ).ready(function() {
                    $('#create_children').modal('show');
                });
            @endif
        @endif
    </script>
@endsection

