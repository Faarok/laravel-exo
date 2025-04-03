@extends('base')

@section('title', 'Nos biens')

@section('content')
    <section class="section">
        <div class="columns is-vcentered">
            <div class="column col-6">
                <p class="title">Nos biens</p>

                <p><span class="has-text-weight-bold">{{ $properties->total() }}</span> résultats correspondent à votre recherche.</p>
            </div>

            <div class="column col-6">
                <form action="{{ route('property.index') }}" method="get">
                    @csrf

                    <div class="columns">
                        <x-form.input class="control column col-6" name="surfaceMin" placeholder="Surface minimum"></x-form.input>
                        <x-form.input class="control column col-6" name="roomMin" placeholder="Nombre de pièce min"></x-form.input>
                    </div>

                    <div class="columns">
                        <x-form.input class="control column col-6" name="priceMax" placeholder="Budget max"></x-form.input>
                        <x-form.input class="control column col-6" name="keyword" placeholder="Mot clef minimum"></x-form.input>
                    </div>

                    <div class="control is-pulled-right">
                        <x-form.button
                            type="submit"
                            color="primary"
                        >Rechercher</x-form.button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="columns">
            @foreach($properties as $property)
                <div class="column col-3 col-desktop-4 col-tablet-6 col-mobile-12">
                    <div class="card">
                        <div class="card-image">
                            <figure class="image is-4by3">
                                <img src="{{ $property->first_image }}" alt="">
                            </figure>
                        </div>

                        <div class="card-content">
                            <p class="title is-5">{{ $property->title }}</p>

                            <p class="content">
                                {{ $property->surface }}m&sup2; - {{ $property->room }} pièce{{ $property->room > 1 ? 's' : '' }} - {{ $property->town }} ({{ $property->zip }})
                            </p>

                            <p class="content">
                                @foreach ($property->options as $option)
                                    {{ $option->name }} {{ $option->name !== $property->options->last()->name ? '|' : '' }}
                                @endforeach
                            </p>

                            <p class="content">
                                {{ $property->description }}
                            </p>

                            <span class="subtitle is-4 has-text-weight-bold">{{ $property->formatted_price }}€</span>
                        </div>

                        <a href="{{ route('property.show', [ $property->id]) }}" class="card-link"></a>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $properties->links() }}
    </section>
@endsection