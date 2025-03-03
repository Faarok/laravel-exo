@extends('base')

@section('title', 'Nos biens')

@section('content')
    <div class="bg-light w-100 py-3 mb-3">
        <div class="container">
            <form action="{{ route('property.index') }}" class="d-flex justify-content-between gap-3" method="get">
                <div class="from-group flex-fill">
                    <input class="form-control" type="number" step="1" name="surfaceMin" id="surfaceMin" placeholder="Surface minimum">
                </div>

                <div class="from-group flex-fill">
                    <input class="form-control" type="number" step="1" name="roomMin" id="roomMin" placeholder="Nombre de pièces min">
                </div>

                <div class="from-group flex-fill">
                    <input class="form-control" type="number" step="1" name="priceMax" id="priceMax" placeholder="Budget max">
                </div>

                <div class="from-group flex-fill">
                    <input class="form-control" type="text" name="keyword" id="keyword" placeholder="Mot clef">
                </div>

                <button class="btn btn-primary">Rechercher</button>
            </form>
        </div>
    </div>

    @if (!$properties->isEmpty())
        <div class="container">
            @foreach ($properties->chunk(4) as $sectionProperties)
                <div class="row mb-3">
                    @foreach ($sectionProperties as $property)
                        <div class="col-sm-12 col-md-6 col-xl-3 mb-4">
                            <div class="card h-100">
                                <img src="{{ !$property->images->isEmpty() ? Storage::url($property->images[0]->path) : Storage::url('default.jpg') }}" class="card-img-top" alt="">
                                <div class="card-body">
                                    <a href="{{ route('property.show', [ $property->id ]) }}"><h5 class="card-title">{{ $property->title }}</h5></a>
                                    <p class="card-text">{{ $property->surface }}m&sup2; - {{ $property->town }} ({{ $property->zip }})</p>
                                    <span class="h3">{{ $property->formatted_price }}€</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach

            {{ $properties->links() }}
        </div>
    @endif
@endsection