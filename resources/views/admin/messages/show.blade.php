@extends('layouts.app')

@section('content')

    <div class="container show-msg-container">
    

        <h1>Richiesta per la location "{{ $apartment->title }}"</h1>

        <div class="d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <div class="my-avatar-container d-inline-block">
                    <img src="{{ asset('images/undraw_male_avatar_323b.svg') }}" class="img-fluid" alt="user avatar">
                </div>
                <div>
                    <span>da: <strong>{{ $message->sender_name . " " . $message->sender_surname}}</strong></span> <br>
                    <span>a: {{ $apartment->user->name . " " . $apartment->user->surname }}</span>
                </div>
            </div>

            <div>
                <span>{{ $carbonDate }}</span>
            </div>
        </div>

        <div class="my-text-container mt-5 mb-5">
            <p>{{ $message->content }}</p>
        </div>

        <div>
            <p class="my-reply">Rispondi immantinente al tuo nuovo cliente all'indirizzo <strong><a href="#"> {{ $message->sender_mail }} </a></strong> <br>
            o chiamalo al numero <strong> {{ $message->phone_number }}! </strong></p>
        </div>
    
    </div>
@endsection