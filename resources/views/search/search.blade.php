@extends('layouts.public')

@section('content')

    <div class="container">

        <h1>Qui ricerca avanzata e mappa</h1>

        {{-- <div class='map' id='map' style="height: 300px"> TomTom map! </div> --}}

        <boolbnb-map v-bind:lat='{{$search_data[0]}}' v-bind:long='{{$search_data[1]}}'
        :apartments='[ @foreach($apartments as $apartment)
                        {
                            name: "{{ $apartment->title }}",
                            lat: {{ $apartment->latitude }},
                            long: {{ $apartment->longitude }},

                        },
            
        @endforeach ]'
        >
        </boolbnb-map>


        @include('apartments.index')
    
    </div>
    
@endsection
