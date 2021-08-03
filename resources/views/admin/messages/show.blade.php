@extends('layouts.app')

@section('content')

    <div class="container">
    

        <h1>Richiesta per la location "{{ $apartment->title }}"</h1>

        <ul>
            <li>Mittente: {{ $message->sender_name }} {{ $message->sender_surname }}</li>
            <li>Telefono: {{ $message->phone_number }}</li>
            <li>Testo: {{ $message->content }}</li>
            <li>Inviato il: {{ $carbonDate }}</li>
        </ul>

        <h3>Rispondi immantinente al tuo nuovo cliente all'indirizzo <strong> {{ $message->sender_mail }} </strong>!</h3>
    
    </div>
@endsection