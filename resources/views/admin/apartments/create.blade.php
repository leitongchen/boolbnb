@extends('layouts.app')

@section('content')


<div class="container">
    <h1>Crea un nuovo appartamento</h1>

    {{$errors}}

    <div id="app">

        <create-form :extra-services='@json($extraServices)'
        :user-id='{{ Auth::user()->id }}'
        ></create-form>

    </div>

</div>

@endsection
