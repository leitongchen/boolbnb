@extends('layouts.app')

@section('content')

<div class="details-apartament">
    {{-- Prima section --}}

    <div class="container">
        <div class="my-cover-container mt-2">
            <img src="{{ asset('storage/' . $apartment->img_url) }}" class="img-fluid" alt="">
        </div>
     
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

        <div class="info-apartment d-flex">

            <div>
                <a href="{{ URL::signedRoute('admin.sponsorship') }}"><i class="fas fa-star pb-2"></i>Fatti trovare più facilmente!</a>
            </div>
            
            <div>
                <i class="fas fa-pencil-alt"></i>
                {{-- <span> Modifica il tuo appartamento</span> --}}
                <a href="{{ URL::signedRoute('admin.apartments.edit', ['apartment' => $apartment->id]) }}">Modifica il tuo appartamento</a>
            </div>


            <div>
                @if ($userId == $apartment->user_id)
                {{-- <a href="{{ URL::signedRoute('admin.visits.show', $apartment->id) }}">Vedi le statistiche</a> --}}
                <i class="fas fa-envelope"></i>
                {{-- <span> Leggi i messaggi ricevuti </span> --}}
                <a href="{{ URL::signedRoute('admin.messages.index', $apartment->id) }}">Leggi i messaggi ricevuti</a>
                @endif
                {{-- <a href="{{ route('messages.create', ['apartment' => $apartment->id]) }}">Manda un messaggio</a> --}}
            </div>

            <div>
                <form action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="orange_button d-inline-block">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </form>
            </div>
        </div>

        {{-- Sesta section --}}
        <section class="map-apartament">

            <div class="map-detail" id="app">
                <apartment-show-map :apartment="{{$apartment}}">
                </apartment-show-map>
            </div>
            <p class="text-center">{{ $apartment->address_street . ' N° ' . $apartment->street_number . ', ' . $apartment->city . ', ' . $apartment->zip_code . ', ' . $apartment->nation }}</p>
        </section>
    </div>


</div>

@endsection

