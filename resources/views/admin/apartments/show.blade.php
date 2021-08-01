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
                <div class="padx col-xl-6 col-md-12 col-sm-12 text-center service_right">
                    <H2>SERVIZI</H2>
                    @foreach($apartment->extra_services as $extraService)
                    <li>{{ $extraService->name }}</li>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Quinta section --}}
        <section class="form-message">
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
        </section>

        {{-- Sesta section --}}
        <section class="map-apartament">
            <ul>
                <li>Latitudine: {{ $apartment->latitude }}</li>
                <li>Longitudine: {{ $apartment->longitude }}</li>
                <li>
                </li>
                <li>{{ $apartment->visible }}</li>
                {{-- @if (count($apartment->extra_services > 0)) --}}
                <li>Servizi inclusi:</li>
                <ul>
                </ul>
                {{-- @endif --}}
            </ul>

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

        </section>

    </div>
    {{-- Settima section --}}
    <footer class="">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h3><a class="text-uppercase  mb-0 text-decoration-none" href="">Informazioni</a></h3>
                    <ul class="list-unstyled ">
                        <li><a href="#" class=" mb-0 text-decoration-none">Come funziona BoolBnb</a></li>
                        <li><a href="#" class=" mb-0 text-decoration-none">News</a></li>
                        <li><a href="#" class=" mb-0 text-decoration-none">BoolBnb Plus</a></li>
                        <li><a href="#" class=" mb-0 text-decoration-none">BoolBnb Luxe</a></li>
                        <li><a href="#" class=" mb-0 text-decoration-none">Lavora con noi</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md- 0">
                    <h3><a class="text-uppercase  mb-0 text-decoration-none" href="">Ospita</a></h3>
                    <ul class="list-unstyled mb-0">
                        <li><a href="#" class=" mb-0 text-decoration-none">Diventa un host</a></li>
                        <li><a href="#" class=" mb-0 text-decoration-none">Offri una esperienza online</a></li>
                        <li><a href="#" class=" mb-0 text-decoration-none">Ospitare responsabilmente</a></li>
                        <li><a href="#" class=" mb-0 text-decoration-none">Centro Risorse</a></li>
                        <li><a href="#" class=" mb-0 text-decoration-none">Community Center</a></li>
                    </ul>

                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md- 0">
                    <h3> <a class="text-uppercase  mb-0 text-decoration-none" href="">Assistenza</a></h3>
                    <ul class="list-unstyled mb-0">
                        <li><a href="#" class=" mb-0 text-decoration-none">La nostra risposta all'emergenza COVID-19</a></li>
                        <li><a href="#" class=" mb-0 text-decoration-none">Centro Assistenza</a></li>
                        <li><a href="#" class=" mb-0 text-decoration-none">Opzioni di cancellazione</a></li>
                        <li><a href="#" class=" mb-0 text-decoration-none">Servizio di supporto al vicinato</a></li>
                        <li><a href="#" class=" mb-0 text-decoration-none">Affidabilità e sicurezza</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md- 0">
                    <h3> <a class="text-uppercase  mb-0 text-decoration-none" href="">Ci trovi anche su</a></h3>
                    <a class="btn btn-outline-dark btn-floating m-1" class="" role="button"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-dark btn-floating m-1" class="" role="button"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-dark btn-floating m-1" class="" role="button"><i class="fab fa-google"></i></a>
                    <a class="btn btn-outline-dark btn-floating m-1" class="" role="button"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <section class="p-3 pt-0 container footer_bottom">
            <div class="row d-flex align-items-center  justify-content-center">
                <div class="text-center">
                    <div class="p-3">
                        © 2021 Boolbnb. Team 7 -
                        <a class=" mb-0 text-decoration-none" href="https://mdbootstrap.com/"> Privacy - </a>
                        <a class=" mb-0 text-decoration-none" href="https://mdbootstrap.com/"> Termini - </a>
                        <a class=" mb-0 text-decoration-none" href="https://mdbootstrap.com/"> Mappa del sito - </a>
                        <a class=" mb-0 text-decoration-none" href="https://mdbootstrap.com/"> Dettagli dell'azienda</a>

                    </div>
                </div>
        </section>
    </footer>
    </section>
</div>

@endsection
