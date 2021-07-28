@extends('layouts.app')

@section('content')
    
<div class="container">
    <h2>Il tuo messaggio è stato inviato!</h2>

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