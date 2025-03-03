@extends('base')

@section('title', 'Création d\'une option')

@section('content')
    <div class="container">
        <h1>Création d'une option</h1>

        @include('admin.option.form')
    </div>
@endsection