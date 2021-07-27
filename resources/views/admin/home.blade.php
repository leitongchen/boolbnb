@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
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

                    <a href="{{ route('admin.apartments.index') }}">Vedi tutti i tuoi appartamenti</a> <br>

                    <a href="{{ route('index') }}">Vai alla pagina iniziale</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
