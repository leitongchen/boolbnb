<table>
    <tbody>
        @foreach($messages as $message)
        <tr>
            <td>{{ $message->sender_name}}</td>
            <td>{{ $message->sender_surname}}</td>
            <td>{{ $message->sender_mail}}</td>
            <td>
                <a href="{{route("messages.show", $message->id) }}">Leggi</a>
                <a href="{{route("messages.create", $message->id) }}">crea</a>
                <form action="{{route("messages.destroy", ["id" => $message->id]) }}" method="post">
                    @csrf

                    @method('DELETE')

                    <input type="submit" value="Cancella messaggio">
                </form>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
