<div x-data="imageHandler">
    <template x-if="message">
        <div class="alert alert-info" x-text="message"></div>
    </template>

    @foreach($images as $image)
        <div class="mb-2">
            <div>
                <img class="w-100" src="{{ Storage::url($image->path) }}" alt="">
                <x-form.button
                    type="button"
                    color="danger"
                    :customClass="'w-100 rounded-0 fw-bold'"
                    :alpineFunc="json_encode([
                        'function' => 'deleteImage',
                        'route' => 'admin.image.destroy',
                        'params' => [
                            'image' => $image->id
                        ]
                    ])"
                >Supprimer</x-form.button>
            </div>
        </div>
    @endforeach
</div>