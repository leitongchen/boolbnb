@extends('layouts.public')

@section('content')

<div class="container">
    <h1>DETTAGLI APPARTAMENTO (PUBBLICO)</h1>

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
                    <img src="{{ $apartment->img_url }}" alt="">
                </li>
                <li>{{ $apartment->visible }}</li>
            </ul>
            <a href="{{ route("messages.create") }}">Invia un messaggio al proprietario</a><br>
            <a href="{{ route('apartments.index') }}">Torna a tutti gli appartamenti</a>
</div>




@endsection
