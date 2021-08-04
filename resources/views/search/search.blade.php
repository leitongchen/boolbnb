@extends('layouts.public')

@section('content')

    <h1>Cerca un alloggio</h1>
    
   
    
    <apartments-index
    :apartments='{{ $apartments }}'
    :latitude="{{$latitude}}"
    :longitude="{{$longitude}}"
    search-query="{{$query}}"
    ></apartments-index> 

    

    
@endsection
