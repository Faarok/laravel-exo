@extends('base')

@section('title', 'Mon agence')

@section('content')

    <x-alerts type="success" :message="session('success')"/>
    <x-alerts type="danger" :message="$errors->any() ? implode('<br>', $errors->all()) : null"/>

    <section class="hero is-medium">
        <div class="hero-body">
            <h1 class="title mb-2">Agence lorem ipsum</h1>

            <p class="subtitle">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quam, libero sit sapiente praesentium animi consequuntur neque voluptate exercitationem tempora deserunt rerum maiores enim quaerat laboriosam sunt hic laudantium impedit beatae.
            </p>
        </div>
    </section>

    <div class="block m-0">
        <h1 class="title">Nos derniers biens</h1>

        @if(!$properties->isEmpty())
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
                                    {{ $property->surface }}m&sup2; - {{ $property->town }} ({{ $property->zip }})

                                    <br>

                                    @foreach ($property->options as $option)
                                        {{ $option->name }} {{ $option->name !== $property->options->last()->name ? '|' : '' }}
                                    @endforeach
                                </p>

                                <p class="subtitle is-4 has-text-weight-bold">{{ $property->formatted_price }}€</p>
                            </div>

                            <a class="card-link" href="{{ route('property.show', [ $property->id ]) }}"></a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection