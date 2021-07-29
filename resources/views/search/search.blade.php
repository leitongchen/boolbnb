@extends('layouts.public')


@section('content')

    <h1>Ricerca avanzata</h1>
    <div id="app">
    
        <apartments-index
        :apartments='{{ $apartments }}'
        ></apartments-index> 
    
    </div>

    @include('apartments.index')

@endsection