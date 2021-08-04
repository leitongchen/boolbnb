@extends('layouts.public')

@section('content')

    <div class="search_box">
    
        <apartments-index
        :apartments='{{ $apartments }}'
        :latitude="{{$latitude}}"
        :longitude="{{$longitude}}"
        search-query="{{$query}}"
        ></apartments-index> 

    </div>

    
@endsection
