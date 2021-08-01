@extends('layouts.app')

@section('content')

<div class="container">
    <h1>TUTTI GLI APPARTAMENTI (PRIVATO)</h1>

    <button class="btn btn-secondary"><a href="{{ route('admin.apartments.create') }}">Aggiungi un nuovo appartamento</a></button>


    @foreach ($apartments as $apartment)
    <h3>{{ $apartment->title }}
        <h3>
            <ul>
                <li>{{ $apartment->address_street . ' N° ' . $apartment->street_number . ', ' . $apartment->city . ', ' . $apartment->zip_code . ', ' . $apartment->nation }}</li>
                <li>Latitudine: {{ $apartment->latitude }}</li>
                <li>Longitudine: {{ $apartment->longitude }}</li>
                <li>Locali: {{ $apartment->rooms_number }}</li>
                <li>Posti letto: {{ $apartment->beds_number }}</li>
                <li>Bagni: {{ $apartment->bathrooms_number }}</li>
                <li>Metratura: {{ $apartment->floor_area . ' mq' }}</li>
                <li>
                    {{-- <img src="{{ $apartment->img_url }}" alt=""> --}}
                    <img src="{{ asset('storage/' . $apartment->img_url) }}">

                </li>
            
                <li>{{ $apartment->visible }}</li>
                <li><a href="{{ URL::signedRoute('admin.apartments.show', $apartment->id) }}">Vedi i dettagli</a></li>
                <li><a href="{{ URL::signedRoute('admin.messages.index', $apartment->id) }}">Leggi i messaggi ricevuti</a></li>


                <form action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="POST">
                    @csrf

                    @method('DELETE')
                    <div class="form-group">
                        <input class="btn btn-danger" type="submit" value="ELIMINA">
                    </div>

                </form>
            </ul>
            @endforeach
</div>

@endsection
