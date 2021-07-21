@extends('layouts.app')

@section('content')

    <h1>Modifica un appartamento</h1>

    <form action="{{ route('admin.apartments.update', ['apartment' => $apartment->id]) }}" method="post" enctype="multipart/form-data">
    @csrf

    @method('PUT')

    <label for="title">Breve descrizione dell'alloggio</label>
    <input type="text" name="title" id="title" value="{{ $apartment->title }}">

    <label for="address_street">Via</label>
    <input type="text" name="address_street" id="address_street" value="{{ $apartment->address_street }}">

    <label for="street_number">Numero civico</label>
    <input type="text" name="street_number" id="street_number" value="{{ $apartment->street_number }}">

    <label for="zip_code">CAP</label>
    <input type="text" name="zip_code" id="zip_code" value="{{ $apartment->zip_code }}">

    <label for="city">Città</label>
    <input type="text" name="city" id="city" value="{{ $apartment->city }}">

    <label for="province">Provincia</label>
    <input type="text" name="province" id="province" value="{{ $apartment->province }}">

    <label for="nation">Stato</label>
    <input type="text" name="nation" id="nation" value="{{ $apartment->nation }}">

    <label for="rooms_number">Locali</label>
    <input type="number" name="rooms_number" id="rooms_number" value="{{ $apartment->rooms_number }}">

    <label for="beds_number">Posti letto</label>
    <input type="number" name="beds_number" id="beds_number" value="{{ $apartment->beds_number }}">

    <label for="bathrooms_number">Bagni</label>
    <input type="number" name="bathrooms_number" id="bathrooms_number" value="{{ $apartment->bathrooms_number }}">

    <label for="floor_area">Superficie</label>
    <input type="number" name="floor_area" id="floor_area" value="{{ $apartment->floor_area }}">

    <label for="visible">Rendi visibile l'appartamento</label>
    <input type="checkbox" name="visible" id="visible" value="{{ $apartment->visible }}"> <br>

    @foreach($extraServices as $extraService)
        <label for="">{{ $extraService->name }}</label>
        <input type="checkbox" name="" id=""> <br>
    @endforeach

    <label for="img_url">Immagine principale</label>
    <input type="file" name="img_url" accept=".jpeg, .jpg, .png">

    <div class="form-group">
        <button type="submit">Crea</button>
    </div>
    

    </form>
    
@endsection