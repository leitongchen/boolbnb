<?php

namespace App\Http\Controllers;

use App\Apartment;
use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // prende tutto dal database
        $messages = Message::all();

        return view("messages.index", ["messages" => $messages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Apartment $apartment)
    {
        return view("messages.create", ['apartment'=>$apartment]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // recupera tutti i dati del form
        $newMessageData = $request->all();

        $newMessage = new Message();

        $newMessage->sender_name = $newMessageData["sender_name"];
        $newMessage->sender_surname = $newMessageData["sender_surname"];
        $newMessage->phone_number = $newMessageData["phone_number"];
        $newMessage->sender_mail = $newMessageData["sender_mail"];
        $newMessage->content = $newMessageData["content"];
        $newMessage->apartment_id = $newMessageData["apartment_id"];


        // salva i dati all'interno del database
        $newMessage->save();

        // dopo aver inviato il form reindirizza al riepilogo di ciò che è stato inviato
        return redirect()-> route("messages.show", $newMessage->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::find($id);

        return view("messages.show", [
            "messages" => $message
        ]);
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
    public function destroy($id)
    {
        $message = Message::findOrFail($id);

        $message->delete();

        return redirect()->route("messages.index");
    }
}
