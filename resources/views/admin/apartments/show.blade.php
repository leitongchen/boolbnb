@extends('layouts.app')

@section('content')

<div class="details-apartament">
    {{-- Prima section --}}
    <div class="slider">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('storage/' . $apartment->img_url) }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('storage/' . $apartment->img_url) }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('storage/' . $apartment->img_url) }}" class="d-block w-100" alt="...">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="container">

        {{-- Seconda section --}}
        <section class="description">
            <div class="row">
                <div class="col-xl-6 col-md-12 col-sm-12">
                    <h1 class="text-center">{{ $apartment->title }}</h1>
                    <p class="text-center">{{ $apartment->address_street . ' N° ' . $apartment->street_number . ', ' . $apartment->city . ', ' . $apartment->zip_code . ', ' . $apartment->nation }}</p>
                </div>
                <div class="col-xl-6 col-md-12 col-sm-12 text-center">
                    <h4>Host</h4>
                    <h5 class="text-uppercase">
                        {{ __(Auth::user()->name) }} {{ __(Auth::user()->surname) }}
                    </h5>
                </div>
            </div>
        </section>

        {{-- Quarta section --}}
        <section class="details">
            <div class="row">
                <div class="padx col-xl-6 col-md-12 col-sm-12 text-center">
                    <h2 class="fw-bold">DETTAGLI</h2>
                    <H4><i class="fas fa-person-booth"></i> STANZE: {{ $apartment->rooms_number }} </H4>
                    <H4><i class="fas fa-bed"></i> LETTI<i class="fa-solid fa-bed-empty"></i>: {{ $apartment->beds_number }} </H4>
                    <H4><i class="fas fa-bath"></i> BAGNI: {{ $apartment->bathrooms_number }} </H4>
                    <H4><i class="fas fa-chart-area"></i> MQ: {{ $apartment->floor_area}} </H4>
                </div>
                @if ($apartment->extra_services->count() > 0)
                <div class="padx col-xl-6 col-md-12 col-sm-12 text-center service_right">
                    <H2>SERVIZI</H2>
                    @foreach($apartment->extra_services as $extraService)
                    <li>{{ $extraService->name }}</li>
                    @endforeach
                </div>
                @endif
            </div>
        </section>



        {{-- Sesta section --}}
        <section class="map-apartament">

            <div class="map-detail" id="app">
                <apartment-show-map :apartment="{{$apartment}}">
                </apartment-show-map>
            </div>

            <br>
            <br>
        </section>
        <div class="info-apartment">

            <button class="btn btn-warning"><a href="{{ URL::signedRoute('admin.apartments.edit', ['apartment' => $apartment->id]) }}">MODIFICA</a></button>
            <form action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="form-group">
                    <input class="btn btn-danger" type="submit" value="ELIMINA">
                </div>
            </form>
            @if ($userId == $apartment->user_id)
            {{-- <a href="{{ URL::signedRoute('admin.visits.show', $apartment->id) }}">Vedi le statistiche</a> --}}
            <a href="{{ URL::signedRoute('admin.messages.index', $apartment->id) }}">Leggi i messaggi ricevuti</a> <br>
            @endif
            <a href="{{ route('messages.create', ['apartment' => $apartment->id]) }}">Manda un messaggio</a>
        </div>
    </div>


</div>

@endsection
