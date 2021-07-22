@extends('layouts.app')

@section('content')

    <h1>TUTTI GLI APPARTAMENTI (PRIVATO)</h1>
    <a href="{{ route('admin.apartments.create') }}">Aggiungi un nuovo appartamento</a>

    @foreach ($apartments as $apartment) 
        <h3>{{ $apartment->title }}<h3>
        <ul>
            <li>{{ $apartment->address_street . ' N° ' . $apartment->street_number . ', ' . $apartment->city . ', ' . $apartment->zip_code . ', ' . $apartment->nation }}</li>
            <li>Latitudine: {{ $apartment->latitude }}</li>
            <li>Longitudine: {{ $apartment->longitude }}</li>
            <li>Locali: {{ $apartment->rooms_number }}</li>
            <li>Posti letto: {{ $apartment->beds_number }}</li>
            <li>Bagni: {{ $apartment->bathrooms_number }}</li>
            <li>Metratura: {{ $apartment->floor_area . ' mq' }}</li>
            <li>
                <img src="{{ $apartment->img_url }}" alt="">
                {{-- <img src="{{ asset('storage/' . $apartment->img_url) }}"> --}}

            </li>
            <li>{{ $apartment->visible }}</li>
            <li><a href="{{ route('admin.apartments.show', $apartment->id) }}">Vedi i dettagli</a></li>

            <form action="{{ route('admin.apartments.destroy', $apartment->id) }}"
                method="POST">
                @csrf

                @method('DELETE')
            
                <input type="submit" value="ELIMINA">
            </form>
        </ul>
       
    @endforeach
    
@endsection