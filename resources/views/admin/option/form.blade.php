<form action="" method="post">
    @csrf
    @method($option->id ? 'PATCH' : 'POST')

    <div class="form-group mb-3">
        <label for="name" class="form-label">Nom</label>
        <input type="text" name="name" id="name" class="form-control" value={{ old('name', $option->name) }}>
        @error('name')
            {{ $message }}
        @enderror
    </div>

    <button class="btn btn-primary">{{ $option->id ? 'Modifier' : 'Sauvegarder' }}</button>
</form>