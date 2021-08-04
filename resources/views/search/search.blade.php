@extends('layouts.public')

@section('content')

    <div class="container">
        <h1>Cerca un alloggio</h1>
    
        <apartments-index
        :apartments='{{ $apartments }}'
        :latitude="{{$latitude}}"
        :longitude="{{$longitude}}"
        search-query="{{$query}}"
        ></apartments-index> 

    </div>

    
@endsection
