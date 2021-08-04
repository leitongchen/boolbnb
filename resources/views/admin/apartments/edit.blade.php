@extends('layouts.app')

@section('content')

        <div class="container">

                {{-- {{$errors}} --}}


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

