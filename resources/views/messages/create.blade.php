@extends('layouts.public')

@section('content')
    
<div class="container">

    <form action="{{ route("messages.store")}}" method="post">
    @csrf

        <label for="sender_name">nome</label>
        <input type="text" name="sender_name" id="sender_name">

        <label for="sender_surname">cognome</label>
        <input type="text" name="sender_surname" id="sender_surname">

        <label for="phone_number">telefono</label>
        <input type="text" name="phone_number" id="phone_number">

        <label for="sender_mail">email</label>
        <input type="email" name="sender_mail" id="sender_mail" value="{{ Auth::check() ? Auth::user()->email : '' }}">

        <label for="message">messaggio</label>
        <input type="text" name="content" id="message">

        <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">


        <input type="submit" value="Invia">
    </form>

</div>
@endsection