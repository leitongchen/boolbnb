<ul>
    <li>nome:{{$messages->sender_name}}</li>
    <li>cognome:{{ $messages->sender_surname}}</li>
    <li>numero:{{$messages->phone_number}}</li>
    <li>email:{{$messages->sender_mail}}</li>
    <li>messaggio:{{$messages->content}}</li>
</ul>

 <a href="{{route("messages.index")}}">Torna alla lista messaggi</a>
