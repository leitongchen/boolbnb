@extends('layouts.app')

@section('content')

    <div class="container my-dashboard-container">

        <div class="card my-card" style="max-width: 100%;">
            <div class="row g-0">
                <div class="col-md-4">
                    <div class="my-user-pic-container m-auto">
                        <img src="{{ asset('images/undraw_Playful_cat_re_bxiu.svg') }}" class="img-fluid my-img-fluid" alt="...">
                    </div>
                    <div class="mb-3 text-center pt-1">
                         @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <span class="my-user-name"><strong>{{ __('Benvenuto '. Auth::user()->name . '!') }} </strong></span>
                    </div>
                    <div class="my-dashboard-list">
                        <ul>
                            <li><a href="{{ URL::signedRoute('admin.apartments.index') }}"><i class="fas fa-concierge-bell pb-2"></i>I tuoi appartamenti</a></li>
                            <li><a href="{{ URL::signedRoute('admin.apartments.create') }}"><i class="fas fa-plus pb-2"></i>Hai una nuova stanza da affittare?</a></li>
                            <li><a href="{{ URL::signedRoute('admin.sponsorship') }}"><i class="fas fa-star pb-2"></i>Fatti trovare più facilmente!</a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-8 my-col">
                    <div class="card-body d-flex justify-content-center my-card-body">

                        <div class="my-apartments-info text-center">
                            <h2 class="card-title">{{ count(Auth::user()->apartments) }}</h2>
                            <p>Appartamenti <br> attivi </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        {{ __('Benvenuto Admin '. Auth::user()->name . '!') }} <br>

                        <br>

                    <a href="{{ route('admin.apartments.index') }}">INDEX APPARTAMENTI PRIVATO</a>

                    </div>
                </div>
            </div>
        </div> --}}
    </div>


@endsection
