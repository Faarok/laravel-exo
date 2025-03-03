@extends('base')

@section('title', 'Dashboard - Options')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mt-5">
            <h1>Gestion des options</h1>

            <div>
                <a href="{{ route('admin.option.create') }}" class="btn btn-primary">Ajouter une option</a>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($options as $option)
                    <tr>
                        <td>{{ $option->name }}</td>
                        <td class="text-end d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.option.edit', [ 'option' => $option->id ]) }}" class="btn btn-secondary">Modifier</a>
                            <form action="{{ route('admin.option.destroy', [ 'option' => $option->id ]) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection