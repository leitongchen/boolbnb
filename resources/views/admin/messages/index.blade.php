@extends('layouts.app')

@section('content')

<div class="container">
    <div class="text-center my-msg-h1">
        @if (count($messages) == 0)
            <div class="my-no-msg text-center ">
                <h1>Non hai messaggi da visualizzare!</h1>

                <div class="my-img-container m-auto w-50">
                    <img src="{{ asset('images/undraw_empty_xct9.svg') }}" class="img-fluid" alt="empty box">
                </div>
            </div>
        @else
        <h1>{{ $apartment->user->name }}, <br> ecco i messaggi inviati al tuo appartamento <br> "{{ $apartment->title }}"</h1>
    </div>

    @foreach($messages as $message)
        <div class="card mb-3">
            <div class="card-header my-card-header">
                Data e ora dell'invio: {{  $message->formattedCreatedAt  }}
            </div>
            <div class="card-body">
                <h5 class="card-title">Sei stato contattato da: {{ $message->sender_name . ' ' . $message->sender_surname }}</h5>
                <p class="card-text">{{ Str::limit($message->content, 150) }}</p>
                <p>Per rispondere al tuo cliente scrivi a: <a href="#"><strong>{{ $message->sender_mail }}</strong></a>.</p>

                <div class="msg-buttons">
                    <div class="orange_button d-inline-block">
                        <a href="{{ URL::signedRoute('admin.messages.show', $message->id) }}">Dettagli</a>
                    </div>

                    <form class="d-inline-block" action="{{ route('admin.messages.destroy', $message->id) }}" method="POST">
                        @csrf

                        @method('DELETE')
                        <button type="submit" class="orange_button d-inline-block">
                            <i class="far fa-trash-alt"></i>
                        </button>

                    </form>
                </div>
         
            </div>
        </div>

    @endforeach
        
        @endif

    <div class="d-flex justify-content-center">
        <div class="orange_button d-inline-block mb-5 text-center">
            <a href="{{ route('admin.apartments.index') }}">Torna a tutti gli appartamenti</a>
        </div>
    </div>
</div>
    
@endsection