@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Messaggi ricevuti appartamento {{ $apartment->id }}</h1>

    <ol>
    @foreach($messages as $message)
        <ul>
            <li>Mittente: {{ $message->sender_name . ' ' . $message->sender_surname }}</li>
            <li>messaggio: <br> {{ $message->content }}</li>
            <li>Inviato il: {{ $message->created_at }}</li>
            <li>Puoi rispondere al seguente indirizzo email: {{ $message->sender_mail }}</li>
        </ul>
        @endforeach
    </ol>

    <a href="{{ route('admin.apartments.index') }}">Torna a tutti gli appartamenti</a>
</div>
    
@endsection