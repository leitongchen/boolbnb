@extends('layouts.public')

@section('content')

    <h1>Ricerca avanzata</h1>
    <div id="app">
    
        <apartments-index
        :apartments='{{ $apartments }}'
        ></apartments-index> 
    
    </div>

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
