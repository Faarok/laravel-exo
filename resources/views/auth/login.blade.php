@extends('base')

@section('title', 'Connexion')

@section('content')
    <div>
        <div class="container w-25">
            <h1 class="my-3">Se connecter</h1>

            <form action="" method="post">
                @csrf

                <div class="form-group mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value={{ old('email') }}>
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control">
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>

                <button class="btn btn-primary mt-3">Se connecter</button>
            </form>
        </div>
    </div>
@endsection