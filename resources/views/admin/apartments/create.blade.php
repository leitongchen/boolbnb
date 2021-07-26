@extends('layouts.app')

@section('content')


<div class="container">
    <h1>Crea un nuovo appatamento</h1>

    {{$errors}}

    <form action="{{ route('admin.apartments.store') }}" method="post" enctype="multipart/form-data">
        @csrf


        <div class="form-group">
            <label for="title">Breve descrizione dell'alloggio</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>


        <div class="form-group">
            <label for="address_street">Via</label>
            <input class="form-control" type="text" name="address_street" id="address_street">
        </div>

        <div class="form-group">
            <label for="street_number">Numero civico</label>
            <input class="form-control" type="text" name="street_number" id="street_number">
        </div>


        <div class="form-group">
            <label for="zip_code">CAP</label>
            <input class="form-control" type="text" name="zip_code" id="zip_code">
        </div>

        <div class="form-group">
            <label for="city">Città</label>
            <input class="form-control" type="text" name="city" id="city">
        </div>

        <div class="form-group">
            <label for="province">Provincia</label>
            <input class="form-control" type="text" name="province" id="province">
        </div>

        <div class="form-group">
            <label for="nation">Stato</label>
            <input class="form-control" type="text" name="nation" id="nation">
        </div>

        <div class="form-group">
            <label for="rooms_number">Locali</label>
            <input class="form-control" type="number" name="rooms_number" id="rooms_number">
        </div>

        <div class="form-group">
            <label for="beds_number">Posti letto</label>
            <input class="form-control" type="number" name="beds_number" id="beds_number">
        </div>

        <div class="form-group">
            <label for="bathrooms_number">Bagni</label>
            <input class="form-control" type="number" name="bathrooms_number" id="bathrooms_number">
        </div>

        <div class="form-group">
            <label for="floor_area">Superficie</label>
            <input class="form-control" type="number" name="floor_area" id="floor_area">
        </div>

        <div class="form-group">
            <label for="visible">Rendi visibile l'appartamento</label>
            <input type="checkbox" name="visible" id="visible" checked> <br>
        </div>

        @foreach($extraServices as $extraService)
            <label>
                <input name="extraServices[]" type="checkbox" value="{{ $extraService->id }}">
            {{ $extraService->name }}
            </label> <br>
        @endforeach

        <div class="form-group">
            <label for="img_url">Immagine principale</label>
            <input type="file" name="img_url" accept=".jpeg, .jpg, .png">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Crea</button>
        </div>


    </form>

</div>


@endsection
