@extends('layouts.public')

@section('content')

    <h1>Ricerca avanzata</h1>
    
    <div id="app-search">
    
        <apartments-index
        :apartments='{{ $apartments }}'
        :latitude="{{$latitude}}"
        :longitude="{{$longitude}}"
        search-query="{{$query}}"
        ></apartments-index> 
        
        {{-- @dump($query) --}}

        {{-- :lat='{{$search_data[0]}}' 
        :long='{{$search_data[1]}}' --}}

        {{-- @dump($searchData) --}}
        {{-- 
        :latitude='{{ $position[0] }}'
        :longitude='{{ $position[1] }}'
        --}}

    </div>

    {{-- <boolbnb-map v-bind:lat='{{$search_data[0]}}' v-bind:long='{{$search_data[1]}}'
    :apartments='[ @foreach($apartments as $apartment)
                    {
                        name: "{{ $apartment->title }}",
                        lat: {{ $apartment->latitude }},
                        long: {{ $apartment->longitude }},

                    },
        
    @endforeach ]'
    >
    </boolbnb-map> --}}


    {{-- @include('apartments.index') --}}
    
    
    
@endsection
