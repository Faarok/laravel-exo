@extends('base')

@section('title', 'Dashboard - Propriétés')

@section('content')
    <div class="container">
        @include('shared.alert')
        <div class="d-flex justify-content-between align-items-center mt-5">
            <h1>Gestion des biens</h1>

            <div>
                <a href="{{ route('admin.property.create') }}" class="btn btn-primary">Ajouter un bien</a>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Surface</th>
                    <th>Prix</th>
                    <th>Ville</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($properties as $property)
                    <tr>
                        <td>{{ $property->title }}</td>
                        <td>{{ $property->surface }}</td>
                        <td>{{ $property->price }}</td>
                        <td>{{ $property->town }}</td>
                        <td class="text-end d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.property.edit', [ 'property' => $property->id ]) }}" class="btn btn-secondary">Modifier</a>
                            <form action="{{ route('admin.property.destroy', [ 'property' => $property->id ]) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $properties->links() }}
    </div>
@endsection