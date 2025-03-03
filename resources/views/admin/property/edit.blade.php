@extends('base')

@section('title', 'Modification d\'un bien')

@section('content')
    <div class="container">
        <h1>Modification d'un bien</h1>

        @include('admin.property.form')
    </div>
@endsection