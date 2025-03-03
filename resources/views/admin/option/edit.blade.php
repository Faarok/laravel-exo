@extends('base')

@section('title', 'Modification d\'une option')

@section('content')
    <div class="container">
        <h1>Modification d'une option</h1>

        @include('admin.option.form')
    </div>
@endsection