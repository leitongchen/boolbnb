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

    <ul>
        <li>nome:{{$messages->sender_name}}</li>
        <li>cognome:{{ $messages->sender_surname}}</li>
        <li>numero:{{$messages->phone_number}}</li>
        <li>email:{{$messages->sender_mail}}</li>
        <li>messaggio:{{$messages->content}}</li>
    </ul>

    @if ($user)
    <a href="{{route("admin.apartments.index")}}">Torna alla lista di appartamenti admin</a>
    @else
    <a href="{{route("apartments.index")}}">Torna alla lista di appartamenti</a>
    @endif


</div>
@endsection