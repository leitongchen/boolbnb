
@extends('layouts.public')

@section('content')

<div class="d-flex flex-column align-items-center my-404-container">
    <div class="p-4 overflow-hidden">
        <img src="{{ asset('images/undraw_Taken_re_yn20.svg') }}" class="img-fluid  my-404-img" alt="">
    </div>
    <h2>Oh no! Pagina non trovata...</h2>
</div>
@endsection