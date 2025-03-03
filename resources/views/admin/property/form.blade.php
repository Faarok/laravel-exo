<form action="" method="post" enctype="multipart/form-data">
    @csrf
    @method($property->id ? 'PATCH' : 'POST')

    <div class="row">
        <div class="col-9">
            <div class="row mb-2">
                <div class="form-group col-6">
                    @include('shared.input', ['type' => 'text', 'label' => 'Titre', 'name' => 'title', 'value' => $property->title])
                </div>

                <div class="form-group col-3">
                    @include('shared.input', ['type' => 'number', 'label' => 'Surface', 'name' => 'surface', 'value' => $property->surface])
                </div>

                <div class="form-group col-3">
                    @include('shared.input', ['type' => 'number', 'label' => 'Prix', 'name' => 'price', 'value' => $property->price])
                </div>
            </div>

            <div class="form-group mb-2">
                @include('shared.input', ['type' => 'textarea', 'label' => 'Description', 'name' => 'description', 'value' => $property->description])
            </div>

            <div class="row mb-2">
                <div class="form-group col-4">
                    @include('shared.input', ['type' => 'number', 'label' => 'Pièces', 'name' => 'room', 'value' => $property->room])
                </div>

                <div class="form-group col-4">
                    @include('shared.input', ['type' => 'number', 'label' => 'Chambres', 'name' => 'bedroom', 'value' => $property->bedroom])
                </div>

                <div class="form-group col-4">
                    @include('shared.input', ['type' => 'number', 'label' => 'Étage', 'name' => 'floor', 'value' => $property->floor])
                </div>
            </div>

            <div class="row mb-2">
                <div class="form-group col-4">
                    @include('shared.input', ['type' => 'text', 'label' => 'Adresse', 'name' => 'address', 'value' => $property->address])
                </div>

                <div class="form-group col-4">
                    @include('shared.input', ['type' => 'text', 'label' => 'Ville', 'name' => 'town', 'value' => $property->town])
                </div>

                <div class="form-group col-4">
                    @include('shared.input', ['type' => 'number', 'label' => 'Code postal', 'name' => 'zip', 'value' => $property->zip])
                </div>
            </div>

            @include('shared.select', ['class' => 'mb-3', 'label' => 'Options', 'name' => 'options', 'options' => $options->pluck('id', 'name'), 'values' => $property->options()->pluck('id'), 'attr' => 'multiple'])

            @include('shared.checkbox', ['class' => 'mb-2', 'label' => 'Vendu', 'name' => 'sell', 'value' => $property->sell])

            <button class="btn btn-primary">{{ $property->id ? 'Modifier' : 'Sauvegarder' }}</button>
        </div>

        <div class="col-3">
            @if(!$property->images->isEmpty())
                <div x-data="{
                    message: null,
                    deleteImage: async function(url) {
                        if(confirm('Êtes-vous sûr de vouloir supprimer cette image ?'))
                        {
                            const response = await fetch(url, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json',
                                }
                            });

                            if(response.ok)
                            {
                                const result = await response.json();
                                this.message = result.message;
                                setTimeout(() => {
                                    this.message = null;
                                    location.reload();
                                }, 3000);
                            }
                        }
                    }
                }">
                    <template x-if="message">
                        <div class="alert alert-info" x-text="message"></div>
                    </template>

                    @foreach ($property->images as $image)
                        <div class="py-3">
                            <button type="button" class="nav-link" @click="deleteImage('{{ route('admin.image.destroy', [ 'image' => $image->id ]) }}')">
                                <img class="w-100" src="{{ Storage::url($image->path) }}" alt="">
                                <div class="bg-danger text-light text-center p-2">Supprimer</div>
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif

            @include('shared.input', ['type' => 'file', 'label' => 'Images', 'name' => 'images', 'attr' => 'multiple'])
        </div>
    </div>
</form>