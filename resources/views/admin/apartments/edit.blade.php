@extends('layouts.app')

@section('content')

        <div class="container">

                {{$errors}}

                <h1>Modifica un appartamento</h1>

                <div id="app">

                        <edit-form
                        :apartment='{{ $apartment }}'
                        :ap-extraservices='@json($apartment->extra_services)'
                        :extra-services='@json($extraServices)'
                        ></edit-form>

                </div>
                @dump($apartment)
                @dump($apartment->extra_services)

                {{-- <form action="{{ route('admin.apartments.update', ['apartment' => $apartment->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        @method('PUT')

                        <div class="form-group">
                                <label for="title">Breve descrizione dell'alloggio</label>
                                <input class="form-control" type="text" name="title" id="title" value="{{ $apartment->title }}">
                        </div>

                        <div class="form-group">
                                <label for="address_street">Via</label>
                                <input class="form-control" type="text" name="address_street" id="address_street" value="{{ $apartment->address_street }}">
                        </div>

                        <div class="form-group">
                                <label for="street_number">Numero civico</label>
                                <input class="form-control" type="text" name="street_number" id="street_number" value="{{ $apartment->street_number }}">
                        </div>

                        <div class="form-group">
                                <label for="zip_code">CAP</label>
                                <input class="form-control" type="text" name="zip_code" id="zip_code" value="{{ $apartment->zip_code }}">
                        </div>

                        <div class="form-group">
                                <label for="city">Città</label>
                                <input class="form-control" type="text" name="city" id="city" value="{{ $apartment->city }}">
                        </div>

                        <div class="form-group">
                                <label for="province">Provincia</label>
                                <input class="form-control" type="text" name="province" id="province" value="{{ $apartment->province }}">
                        </div>

                        <div class="form-group">
                                <label for="nation">Stato</label>
                                <input class="form-control" type="text" name="nation" id="nation" value="{{ $apartment->nation }}">
                        </div>

                        <div class="form-group">
                                <label for="rooms_number">Locali</label>
                                <input class="form-control" type="number" name="rooms_number" id="rooms_number" value="{{ $apartment->rooms_number }}">
                        </div>

                        <div class="form-group">
                                <label for="beds_number">Posti letto</label>
                                <input class="form-control" type="number" name="beds_number" id="beds_number" value="{{ $apartment->beds_number }}">
                        </div>

                        <div class="form-group">
                                <label for="bathrooms_number">Bagni</label>
                                <input class="form-control" type="number" name="bathrooms_number" id="bathrooms_number" value="{{ $apartment->bathrooms_number }}">
                        </div>

                        <div class="form-group">
                                <label for="floor_area">Superficie</label>
                                <input class="form-control" type="number" name="floor_area" id="floor_area" value="{{ $apartment->floor_area }}">
                        </div>

                        <div class="form-group">
                                <label for="visible">Rendi visibile l'appartamento</label>
                                <input type="checkbox" name="visible" id="visible" value="{{ $apartment->visible }}"> <br>
                        </div>

                        @foreach($extraServices as $extraService)
                        <label>
                                <input name="extraServices[]" type="checkbox" value="{{ $extraService->id }}" {{ $apartment->extra_services->contains($extraService) ? 'checked' : '' }}>
                                {{ $extraService->name }} <br>
                        </label>
                        @endforeach


                        <div class="form-group">
                                <label for="img_url">Immagine principale</label>
                                <input class="form-control" type="file" name="img_url" accept=".jpeg, .jpg, .png">
                        </div>

                        <div class="form-group">
                        <div class="form-group">
                        <button type="submit" class="btn btn-success">Fatto</button>
                        </div>
                </form> --}}
        </div>



@endsection


@section('js-link')

    <script src="{{ asset('js/app.js') }}"></script>

@endsection