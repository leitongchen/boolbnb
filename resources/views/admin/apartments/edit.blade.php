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
                        :user-id='{{ $userId }}'
                        ></edit-form>

                </div>

        </div>


@endsection

