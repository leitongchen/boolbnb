@extends('layouts.app')

@section('content')

<div class="container">
    <div class="apartment-index-container">
        <h1 class="text-center">I tuoi appartamenti</h1>

        <div class="d-flex justify-content-center pt-2 pb-5">
            <div class="m-auto">
                <a href="{{ route('admin.apartments.create') }}" class="orange_button pt-2 pb-2">Aggiungi un nuovo appartamento</a>
            </div>
        </div>

        @if (count($apartments) == 0)
        <div class="my-no-msg text-center ">
            <p>Non c'è nulla qui</p>

            <div class="my-img-container m-auto w-50">
                <img src="{{ asset('images/undraw_empty_xct9.svg') }}" class="img-fluid" alt="empty box">
            </div>
        </div>
        @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 card-group">
            @foreach ($apartments as $apartment)
            <div class="col mb-3">
                <div class="card my-apartment-card overflow-hidden h-100">
                    <div class="my-card-img-container">
                        <img src="{{ asset('storage/' . $apartment->img_url) }}" class="card-img-top my-card-img-top img-fluid" alt="...">
                    </div>
                    <div class="card-body my-card-body d-flex align-content-around flex-column">
 
                        <h5 class="card-title my-card-title">{{ $apartment->title }}</h5>
                        <p>
                            @if ($apartment->rooms_number === 1) 
                                <span>{{ $apartment->rooms_number }} stanza - </span>
                            @else 
                                <span>{{ $apartment->rooms_number }} stanze - </span>
                            @endif

                            @if ($apartment->beds_number === 1) 
                                <span>{{ $apartment->beds_number }} letto - </span>
                            @else 
                                <span>{{ $apartment->beds_number }} letti - </span>
                            @endif

                            @if ($apartment->bathrooms_number === 1) 
                                <span>{{ $apartment->bathrooms_number }} bagno</span>
                            @else 
                                <span>{{ $apartment->bathrooms_number }} bagni</span>
                            @endif
                        </p>

                        @if ($apartment->extra_services->count() > 0)
                        <p class="card-text">
                            @foreach($apartment->extra_services as $extraService)
                            <span>{{ $extraService->name }}
                                @if(!$loop->last)
                                -
                                @endif
                            </span>
                            @endforeach
                        </p>
                        @endif

                        <div class="m-auto my-btn-container">
                            <a href="{{ URL::signedRoute('admin.apartments.show', $apartment->id) }}" class="white_button">Vedi i dettagli</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

@endsection

         {{--  DATI CHE NON HO INSERITO NELLA CARD       
                    <li>{{ $apartment->address_street . ' N° ' . $apartment->street_number . ', ' . $apartment->city . ', ' . $apartment->zip_code . ', ' . $apartment->nation }}</li>
                    <li>Latitudine: {{ $apartment->latitude }}</li>
                    <li>Longitudine: {{ $apartment->longitude }}</li>
                    <li>Metratura: {{ $apartment->floor_area . ' mq' }}</li>
                
                    <li><a href="{{ URL::signedRoute('admin.apartments.show', $apartment->id) }}">Vedi i dettagli</a></li>
                    <li><a href="{{ URL::signedRoute('admin.messages.index', $apartment->id) }}">Leggi i messaggi ricevuti</a></li>

                    <form action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="POST">
                        @csrf

                        @method('DELETE')
                        <div class="form-group">
                            <input class="btn btn-danger" type="submit" value="ELIMINA">
                        </div>

                    </form> --}}
