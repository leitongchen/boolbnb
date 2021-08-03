@extends('layouts.app')

@section('content')

<div class="container">
    <div class="text-center ">
        @if (count($messages) == 0)
            <div class="my-no-msg text-center ">
                <h1>Non hai messaggi da visualizzare!</h1>

                <div class="my-img-container m-auto w-50">
                    <img src="{{ asset('images/undraw_empty_xct9.svg') }}" class="img-fluid" alt="empty box">
                </div>
            </div>
        @else
            <h1>Messaggi ricevuti appartamento {{ $apartment->id }}</h1>
    </div>

    <table class="table">
        <thead>
            <th>Mittente</th>
            <th>Messaggio</th>
            <th>Data invio</th>
            <th>Email mittente</th>
            <th>Azioni</th>
        </thead>

        <tbody>
            @foreach($messages as $message)
                <tr>
                    <td>{{ $message->sender_name . ' ' . $message->sender_surname }}</td>
                    <td>{{ Str::limit($message->content, 50) }}</td>
                    <td>{{ $message->formattedCreatedAt }}</td>
                    <td>{{ $message->sender_mail }}</td>
                    <td>
                        <a href="{{ URL::signedRoute('admin.messages.show', $message->id) }}">Dettagli</a>

                        <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST">
                        @csrf

                        @method('DELETE')
                        <div class="form-group">
                            <input class="btn btn-danger" type="submit" value="ELIMINA">
                        </div>

                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    
    </table>
    @endif

    <div class="orange_button d-inline-block mb-5">
        <a href="{{ route('admin.apartments.index') }}">Torna a tutti gli appartamenti</a>
    </div>
</div>
    
@endsection