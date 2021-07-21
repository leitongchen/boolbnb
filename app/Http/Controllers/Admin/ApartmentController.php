<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use App\Extra_service;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incomingData = Apartment::all();

        $data = [
            'apartments' => $incomingData
        ];

        return view('admin.apartments.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $extraServices = Extra_service::all();

        return view('admin.apartments.create', ['extraServices' => $extraServices]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formData = $request->all();
        $newApartment = new Apartment;
        $newApartment->fill($formData);

        $newApartment->user_id = $request->user()->id;

         //carico l'immagine di copertina
        if (key_exists("img_url", $formData)) {
            $storageResult = Storage::put("img_url", $formData["img_url"]);
            $newApartment->img_url = $storageResult;
        }

        $newApartment->save();

        return redirect()->route('admin.apartments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        // $apartment = Apartment::findOrFail($id);
        $extraServices = Extra_service::all();

        $data = [
            'apartment' => $apartment,
            'extraServices' => $extraServices
        ];

        return view('admin.apartments.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        $formData = $request->all();

        if (key_exists("img_url", $formData)) {
            if ($apartment->img_url) {
                Storage::delete($apartment->img_url);
            }

            $storageResult = Storage::put("img_url", $formData["img_url"]);

            $formData["img_url"] = $storageResult;
        }

        $apartment->update($formData);

        return redirect()->route('admin.apartments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
