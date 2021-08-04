@extends('layouts.app')

@section('content')
    
<div class="container show-msg-container">
    <h1>Il tuo messaggio è stato inviato!</h1>

    <div class="d-flex justify-content-between">
        <div class="d-flex align-items-center">
            <div class="my-avatar-container d-inline-block">
                <img src="{{ asset('images/undraw_male_avatar_323b.svg') }}" class="img-fluid" alt="user avatar">
            </div>
            <div>
                <span>da: <strong>{{ $messages->sender_name . " " . $messages->sender_surname}}</strong></span> <br>
                <span>a: {{ $apartment->user->name . " " . $apartment->user->surname }}</span>
            </div>
        </div>

        <div>
            <span>{{ $carbonDate }}</span>
        </div>
    </div>

    <div class="my-text-container mt-5 mb-5">
        <p>{{ $messages->content }}</p>
    </div>

    <div>
        <p class="my-reply">L'host che hai contattato ha ricevuto i seguenti dati da te forniti: <br>
        indirizzo email: <strong><a href="#"> {{ $messages->sender_mail }} </a></strong>; <br>
        numero di telefono <strong> {{ $messages->phone_number }}. </strong></p>
    </div>

</div>
@endsection