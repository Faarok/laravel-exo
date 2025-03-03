@extends('base')

@section('title', $property->title)

@section('content')
    <div class="container py-3">
        <div class="row mb-4">
            <div class="col-6 border-2 border-end">
                <div>
                    <h1>{{ $property->title }}</h1>
                    <h2>{{ $property->room }} pièces - {{ $property->surface }}m&sup2;</h2>
                </div>

                <p class="h1 text-primary">{{ $property->formatted_price }}€</p>
            </div>

            <div class="col-6">
                <h3>Intéressé par ce bien ?</h3>

                @include('shared.alert')

                <form action="{{ route('property.contact', $property) }}" method="post">
                    @csrf

                    <div class="row mb-2">
                        @include('shared.input', ['class' => 'col-6', 'type' => 'text', 'name' => 'firstname', 'label' => 'Prénom'])
                        @include('shared.input', ['class' => 'col-6', 'type' => 'text', 'name' => 'name', 'label' => 'Nom'])
                    </div>

                    <div class="row mb-2">
                        @include('shared.input', ['class' => 'col-6', 'type' => 'tel', 'name' => 'phone', 'label' => 'Téléphone'])
                        @include('shared.input', ['class' => 'col-6', 'type' => 'email', 'name' => 'mail', 'label' => 'Email'])
                    </div>

                    @include('shared.input', ['type' => 'textarea', 'name' => 'content', 'label' => 'Message'])

                    <button class="btn btn-primary mt-3">Nous contacter</button>
                </form>
            </div>
        </div>

        <div class="row mb-4 justify-content-center">
            <div class="col-lg-12 col-xl-8">
                @if(!$property->images->isEmpty() && count($property->images) > 1)
                    <div id="carousel-images position-relative" class="carousel slide">
                        @if($property->sell)
                            <div class="bg-info w-100 position-absolute top-0 start-0 text-center py-2">
                                <p class="h2 m-0">VENDU</p>
                            </div>
                        @endif
                        <div class="carousel-inner">
                            @foreach ($property->images->all() as $key => $image)
                                <div @class(['carousel-item', 'active' => $key === array_key_first($property->images->all())])>
                                    <img src="{{ Storage::url($image->path) }}" class="d-block w-100" alt="">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-images" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-images" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                @else
                    <div class="position-relative">
                        @if($property->sell)
                            <div class="bg-info w-100 position-absolute top-0 start-0 text-center py-2">
                                <p class="h2 m-0">VENDU</p>
                            </div>
                        @endif
                        <img src="{{ $property->first_image }}" class="d-block w-100" alt="">
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <p>
                {{ $property->description }}
            </p>
        </div>

        <div class="row">
            <div class="col-8">
                <h3>Caractéristiques</h3>
                <table class="table table-striped">
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
            <div class="col-4">
                <h3>Spécificités</h3>

                <ul class="list-group">
                    @foreach ($property->options as $option)
                        <li class="list-group-item">{{ $option->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection