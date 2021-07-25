@extends('layouts.app')

@section('content')

<div class="container">

    <h1>DETTAGLI APPARTAMENTO (PRIVATO)</h1>

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
        </li>
        <li>{{ $apartment->visible }}</li>

        {{-- @if (count($apartment->extraService > 0)) --}}
            <li>Servizi inclusi:</li>
            @foreach($apartment->extraServices as $extraService)
                <ul>
                    <li>
                        {{ $extraService->name }}
                    </li>
                </ul>
            @endforeach
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
        <a href="#">Leggi i messaggi ricevuti</a>
    @endif


</div>


@endsection