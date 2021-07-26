@extends('layouts.app')

@section('content')

<div class="container">

    @if (count($messages) == 0)
        <h1>Non hai messaggi da visualizzare</h1>
    @else
        <h1>Messaggi ricevuti appartamento {{ $apartment->id }}</h1>
    @endif

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
                    <td>{{ $message->created_at }}</td>
                    <td>{{ $message->sender_mail }}</td>
                    <td>
                        {{-- <a href="{{ route('admin.messages.show') }}">Dettagli</a> --}}
                        <a href="">Elimina</a>

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

    <a href="{{ route('admin.apartments.index') }}">Torna a tutti gli appartamenti</a>
</div>
    
@endsection