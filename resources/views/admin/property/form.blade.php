<form action="" method="post" enctype="multipart/form-data">
    @csrf
    @method($property->id ? 'PATCH' : 'POST')

    <div class="row">
        <div class="col-9">
            <div class="row mb-2">
                <div class="form-group col-6">
                    <x-form.input :type="__('text')" :label="__('Titre')" :name="__('title')" :value="$property->title"></x-input>
                </div>

                <div class="form-group col-3">
                    <x-form.input :type="__('number')" :label="__('Surface')" :name="__('surface')" :value="$property->surface"></x-input>
                </div>

                <div class="form-group col-3">
                    <x-form.input :type="__('number')" :label="__('Prix')" :name="__('price')" :value="$property->price"></x-input>
                </div>
            </div>

            <div class="form-group mb-2">
                <x-form.textarea :label="__('Description')" :name="__('description')" :value="$property->description"></x-textarea>
            </div>

            <div class="row mb-2">
                <div class="form-group col-4">
                    <x-form.input :type="__('number')" :label="__('Pièces')" :name="__('room')" :value="$property->room"></x-input>
                </div>

                <div class="form-group col-4">
                    <x-form.input :type="__('number')" :label="__('Chambres')" :name="__('bedroom')" :value="$property->bedroom"></x-input>
                </div>

                <div class="form-group col-4">
                    <x-form.input :type="__('number')" :label="__('Étage')" :name="__('floor')" :value="$property->floor"></x-input>
                </div>
            </div>

            <div class="row mb-2">
                <div class="form-group col-4">
                    <x-form.input :type="__('text')" :label="__('Adresse')" :name="__('address')" :value="$property->address"></x-input>
                </div>

                <div class="form-group col-4">
                    <x-form.input :type="__('text')" :label="__('Ville')" :name="__('town')" :value="$property->town"></x-input>
                </div>

                <div class="form-group col-4">
                    <x-form.input :type="__('number')" :label="__('Code postal')" :name="__('zip')" :value="$property->zip"></x-input>
                </div>
            </div>

            <div class="form-group mb-3">
                <x-form.tom-select
                    label="Options"
                    name="options"
                    :options="$options->pluck('id', 'name')"
                    :values="$property->options()->pluck('id')"
                    placeholder="Sélection des options"
                    multiple
                    aria-autocomplete="off"
                ></x-tom-select>
            </div>

            <x-form.switch class="mb-2" label="Vendu ?" name="sell" :value="$property->sell"></x-switch>
            <x-form.button type="submit" color="primary">{{ $property->id ? 'Modifier' : 'Sauvegarder' }}</x-button>
        </div>

        <div class="col-3">
            <x-form.input type="file" label="Images" name="images" attr="multiple" class="mb-2"></x-input>

            <x-form.deletable-images :images="$property->images"></x-form-deletable-images>
        </div>
    </div>
</form>