<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  Vedi i tutti i messaggi di un appartamento
    public function index(Apartment $apartment)
    {

        $messages = $apartment->messages()->get();

        $data = [
            'apartment' => $apartment,
            'messages' => $messages,
        ];

        //formatta la data
        foreach ($data['messages'] as $message) {
            $date = $message->created_at;

            $carbonDate = Carbon::parse($date);

            $formattedDate = $carbonDate->format("d/m/y h:i:s");

            $message->formattedCreatedAt = $formattedDate;
        }

        return view('admin.messages.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //vedi i dettagli di un solo messaggio
    public function show(Message $message, Apartment $apartment)
    {
        $apartment = Apartment::where('id', '=', $message->apartment_id)->get()->first();
        //formatta la data
        $carbonDate = Carbon::parse($message->created_at)->format("d/m/y h:i:s");
       
        $data = [
            'message' => Message::findOrFail($message -> id),
            'carbonDate' => $carbonDate,
            'apartment' => $apartment
        ];

        return view('admin.messages.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //elimina il messaggio se l'utente è il destinatario
    //no redirect (lato client)
    public function destroy(Message $message)
    {
        if($message->apartment->user_id = Auth::id()) {
            $message->delete();
        }

    }

}
