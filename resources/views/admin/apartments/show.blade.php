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
                @if ($apartment->extra_services->count() > 0))
                <div class="padx col-xl-6 col-md-12 col-sm-12 text-center service_right">
                    <H2>SERVIZI</H2>
                    @foreach($apartment->extra_services as $extraService)
                    <li>{{ $extraService->name }}</li>
                    @endforeach
                </div>
                @endif
            </div>
        </section>

        {{-- Quinta section --}}
        {{-- <section class="form-message">
            <h2 class="text-center">Ti piace questo appartamento?</h2>
            <form action="{{ route("messages.store")}}" method="post">
                @csrf
                <div class="text-center">
                    <h4>Invia un messaggio a</h4>
                    <h5 class="text-uppercase"> {{ __(Auth::user()->name) }} {{ __(Auth::user()->surname) }}</h5>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Nome" name="sender_name" id="sender_name">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Cognome" name="sender_surname" id="sender_surname">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Indirizzo mail" name="sender_mail" id="sender_mail" value="{{ Auth::check() ? Auth::user()->email : '' }}">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Cellulare" name="phone_number" id="phone_number">
                    </div>
                </div>
                <br>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Il tuo messaggio:" id="floatingTextarea" name="content" id="message"></textarea>
                </div>
                <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">
                <br>
                <div class="gap-2 text-center d-grid">
                    <input class="btn btn-primary" type="submit" value="Invia">
                </div>

            </form>
        </section> --}}

    {{-- <ul>
        <li>{{ $apartment->address_street . ' N° ' . $apartment->street_number . ', ' . $apartment->city . ', ' . $apartment->zip_code . ', ' . $apartment->nation }}</li>
        <li>Latitudine: {{ $apartment->latitude }}</li>
        <li>Longitudine: {{ $apartment->longitude }}</li>
        <li>Locali: {{ $apartment->rooms_number }}</li>
        <li>Posti letto: {{ $apartment->beds_number }}</li>
        <li>Bagni: {{ $apartment->bathrooms_number }}</li>
        <li>Metratura: {{ $apartment->floor_area . ' mq' }}</li>
        <li>
            <img src="{{ $apartment->img_url }}" alt="">
        </li>
        <li>{{ $apartment->visible }}</li>


        @if ($apartment->extra_services->count() > 0))
        <li>Servizi inclusi:
            <ul>
                @foreach($apartment->extra_services as $extraService)
                <li>
                    {{ $extraService->name }}
                </li>
                @endforeach
            </ul>
        </li>
        @endif
    </ul> --}}

    <button class="btn btn-warning"> <a href="{{ route('admin.apartments.edit', ['apartment' => $apartment->id]) }}">MODIFICA</a> <br></button>



    <form action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="POST">
        @csrf

        @method('DELETE')

        <div class="form-group">
            <input class="btn btn-danger" type="submit" value="ELIMINA">
        </div>
    </form>

    <a href="{{ route('admin.apartments.index') }}">Torna a tutti gli appartamenti</a>
    <br>

    @if ($userId == $apartment->user_id)
    <a href="{{ route('admin.visits.show', $apartment->id) }}">Vedi le statistiche</a>
    <br>
    <a href="{{ route('admin.messages.index', $apartment->id) }}">Leggi i messaggi ricevuti</a> <br>
    @endif


    <a href="{{ route('messages.create', ['apartment' => $apartment->id]) }}">Manda un messaggio</a>

    <div id="app">
        <apartment-show-map
        :apartment="{{$apartment}}">
        </apartment-show-map>
    </div>

    </div>
    </section>
</div>

@endsection
