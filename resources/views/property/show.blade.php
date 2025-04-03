@extends('base')

@section('title', $property->title)

@section('content')
    <div class="container is-fluid">
        <section class="section">
            <div class="columns is-vcentered is-tablet-vertical">
                <div class="column col-4 col-tablet-12">
                    <div class="content">
                        <h1>{{ $property->title }}</h1>
                        <p class="subtitle">{{ $property->room }} pièces - {{ $property->surface }}m&sup2;</p>

                        <p class="alt-title has-text-primary has-text-weight-bold">{{ $property->formatted_price }}€</p>
                    </div>
                </div>

                <div
                    x-data="imageHandler"
                    class="column {{ $mainImages->isEmpty() ? 'col-5 m-auto' : 'col-8 col-tablet-12' }} main-gallery is-relative"
                >
                    @if($property->sell)
                        <div class="image-overlay">
                            <span>Ce bien n'est plus disponible</span>
                        </div>
                    @endif

                    @if($mainImages->isEmpty())
                        <div class="image-overlay">
                            <span>Photos non-disponibles</span>
                        </div>

                        <figure class="image is-4by3">
                            <img src="{{ $property->first_image }}" alt="">
                        </figure>
                    @else
                        <div class="fixed-grid has-3-cols m-0">
                            <div class="grid">
                                @foreach($mainImages as $image)
                                    <div class="cell {{ $image->id === $images->first()->id ? 'is-row-span-2 is-col-span-2' : '' }}">
                                        <figure x-on:click="galleryOpen()" class="image is-4by3">
                                            <img src="{{ Storage::url($image->path) }}" alt="">
                                        </figure>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button x-on:click="galleryOpen()" type="button" class="button is-responsive is-info show-all">
                            <span class="icon"><i class="fas fa-images"></i></span>
                            <span>Afficher toutes les photos</span>
                        </button>
                    @endif
                </div>

                <div x-data="imageHandler" class="modal" data-modal="gallery">
                    <div class="modal-background is-plain"></div>

                    <button type="button" x-on:click="galleryClose()" class="modal-close is-large" aria-label="close"></button>

                    <div class="modal-content is-fullscreen">
                        <div class="modal-content-header">
                            <p class="title">Liste des photos</p>
                        </div>

                        <div class="modal-content-body">
                            <div class="grid is-gap-2 is-col-min-6 modal-mobile-gallery">
                                @foreach($images as $key => $image)
                                    <div class="cell">
                                        <a href="#image_{{ $key }}">
                                            <figure class="image is-4by3">
                                                <img src="{{ Storage::url($image->path) }}" alt="">
                                            </figure>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <hr>

                            <div class="columns">
                                @foreach($images as $key => $image)
                                    <div class="column col-6 col-tablet-12">
                                        <figure class="image is-4by3" id="image_{{ $key }}">
                                            <img src="{{ Storage::url($image->path) }}" alt="">
                                        </figure>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="content">
                <p>{{ $property->description }}</p>
            </div>

            <div class="columns">
                <div class="column col-8">
                    <p class="subtitle">Caractéristiques</p>

                    <div class="table-rounded border border-width-2 border-color-text-20">
                        <table class="table is-striped is-fullwidth">
                            <tr>
                                <td>Surface habitable</td>
                                <td>{{ $property->surface }}m&sup2;</td>
                            </tr>
                            <tr>
                                <td>Pièces</td>
                                <td>{{ $property->room }}</td>
                            </tr>
                            <tr>
                                <td>Chambres</td>
                                <td>{{ $property->bedroom }}</td>
                            </tr>
                            <tr>
                                <td>Étage</td>
                                <td>{{ $property->floor }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="column col-4">
                    <p class="subtitle">Spécificités</p>

                    <div class="tags are-medium">
                        @foreach ($property->options as $option)
                            <a class="tag is-info is-hoverable">{{ $option->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        @if(!$property->sell)
            <section class="section">
                <div class="column col-5 col-tablet-1 p-0">
                    <p class="title has-text-centered">{{ __('Interested in this property ?') }}</p>

                    {{-- @if(session('success')) --}}
                        <x-alert type="success" :message="session('success')"></x-alert>
                    {{-- @endif --}}

                    <div class="box border border-width-2 border-color-text-25">
                        <form action="{{ route('property.contact', $property) }}" method="post">
                            @csrf

                            <div class="columns">
                                <div class="column col-6 col-mobile-2">
                                    <x-form.input type="text" name="firstname" label="Prénom" placeholder="Prénom"></x-form.input>
                                </div>

                                <div class="column col-6 col-mobile-2">
                                    <x-form.input type="text" name="name" label="Nom" placeholder="Nom"></x-form.input>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column col-6 col-mobile-2">
                                    <x-form.input type="tel" name="phone" label="Téléphone" icon="phone" placeholder="N° de téléphone"></x-form.input>
                                </div>

                                <div class="column col-6 col-mobile-2">
                                    <x-form.input type="email" name="mail" label="Email" icon="envelope" placeholder="Adresse mail"></x-form.input>
                                </div>
                            </div>

                            <x-form.textarea name="content" label="Message" placeholder="Votre message"></x-form.textarea>

                            <x-form.button class="mt-2" type="submit" customClass="primary">Nous contacter</x-form.button>
                        </form>
                    </div>
                </div>
            </section>
        @endif
    </div>
@endsection