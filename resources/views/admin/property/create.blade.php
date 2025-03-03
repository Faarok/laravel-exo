@extends('base')

@section('title', 'Ajout d\'un bien')

@section('content')
    <div class="container">
        <h1>Création d'un bien</h1>

        @include('admin.property.form')
    </div>
@endsection