@extends('base')

@section('title', 'Mon agence')

@section('content')

    <x-alert type="success" class="fw-bold" id="test">
        Des informations
    </x-alert>

    <div class="bg-light w-100">
        <div class="container py-5 mb-5">
            <h1 class="text-center">Agence lorem ipsum</h1>

            <p class="text-center">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quam, libero sit sapiente praesentium animi consequuntur neque voluptate exercitationem tempora deserunt rerum maiores enim quaerat laboriosam sunt hic laudantium impedit beatae.
            </p>
        </div>
    </div>

    <div class="container">
        <h1>Les derniers biens</h1>

        @if(!$properties->isEmpty())
            <div class="row">
                @foreach ($properties as $property)
                    <div class="col-sm-12 col-md-6 col-xl-3">
                        <div class="card">
                            <img src="{{ $property->first_image }}" class="card-img-top" alt="">

                            <div class="card-body">
                                <a href="{{ route('property.show', [ $property->id ]) }}"><h5 class="card-title">{{ $property->title }}</h5></a>
                                <p class="card-text">{{ $property->surface }}m&sup2; - {{ $property->town }} ({{ $property->zip }})</p>
                                <span class="h3">{{ $property->price }}€</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection