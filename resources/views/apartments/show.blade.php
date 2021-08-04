{{-- Pagina dettaglio singolo appartamento pubblico --}}
@extends('layouts.public')

@section('content')

{{-- Slider --}}
<div class="details-apartament">

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
    {{-- Titolo, indirizzo e Host --}}
    <div class="container">
        <section class="description">
            <div class="row">
                <div class="col-xl-6 col-md-12 col-sm-12">
                    <h1 class="text-center">{{ $apartment->title }}</h1>
                    <p class="text-center">{{ $apartment->address_street . ' N° ' . $apartment->street_number . ', ' . $apartment->city . ', ' . $apartment->zip_code . ', ' . $apartment->nation }}</p>
                </div>
                <div class="col-xl-6 col-md-12 col-sm-12 text-center">
                    <h4>Host</h4>
                    <h5 class="text-uppercase">
                        {{$apartment->user->name . ' ' . $apartment->user->surname}}
                    </h5>
                </div>
            </div>
        </section>

        {{-- Pagina dettaglio app e servizi extra --}}
        <section class="details">
            <div class="row">
                <div class="padx col-xl-6 col-md-12 col-sm-12 text-center">
                    <h2 class="fw-bold">DETTAGLI</h2>
                    <H4><i class="fas fa-person-booth"></i> STANZE: {{ $apartment->rooms_number }} </H4>
                    <H4><i class="fas fa-bed"></i> LETTI<i class="fa-solid fa-bed-empty"></i>: {{ $apartment->beds_number }} </H4>
                    <H4><i class="fas fa-bath"></i> BAGNI: {{ $apartment->bathrooms_number }} </H4>
                    <H4><i class="fas fa-chart-area"></i> MQ: {{ $apartment->floor_area}} </H4>


                </div>
                <div class="padx col-xl-6 col-md-12 col-sm-12 text-center service_right">
                    <H2>SERVIZI</H2>
                    @foreach($apartment->extra_services as $extraService)
                    <li>{{ $extraService->name }}</li>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="map-apartament">

            <div class="map-detail" id="app">
                <apartment-show-map :apartment="{{$apartment}}">
                </apartment-show-map>
            </div>
            <p class="text-center">{{ $apartment->address_street . ' N° ' . $apartment->street_number . ', ' . $apartment->city . ', ' . $apartment->zip_code . ', ' . $apartment->nation }}</p>
        </section>

        {{-- Form per inviare un messaggio --}}
        <section class="form-message">
            <h2 class="text-center">Ti piace questo appartamento?</h2>
            <form action="{{ route("messages.store")}}" method="post">
                @csrf
                <div class="text-center">
                    <h4>Invia un messaggio a</h4>
                    <h5 class="text-uppercase">
                        {{$apartment->user->name . ' ' . $apartment->user->surname}}
                    </h5>
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
        </section>
    </div>
</div>

@endsection
