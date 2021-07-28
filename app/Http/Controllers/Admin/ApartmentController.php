<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use App\Extra_service;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        //trova gli appartamenti dell'utente loggato
        //Da ordinare!!
        $userId = Auth::id();
        $userApartments = Apartment::all()->where('user_id', '=', $userId);
        // $incomingData = Apartment::orderBy('updated_at', 'DESC')->get();


        $data = [
            'apartments' => $userApartments
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
        // $userId = Auth::user()->id;

        return view('admin.apartments.create', [
            'extraServices' => $extraServices,
            // 'userId' => $userId,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'address_street' => 'required|max:255',
            'street_number' => 'required|max:10',
            'city' => 'required|max:100',
            'zip_code' => 'required|max:10',
            'province' => 'required|max:100',
            'nation' => 'required|max:100',
            'rooms_number' => 'required|integer',
            'beds_number' => 'required|integer',
            'bathrooms_number' => 'required|integer',
            'floor_area' => 'required|numeric',
            'img_url' => 'required',
            'visible' => 'required'
        ]);

        // dump($request);
        // dump($request->user());
        // return; 

        $formData = $request->all();
        $newApartment = new Apartment;
        $newApartment->fill($formData);
        
        $newApartment->user_id = $formData['user_id'];


        // dump($newApartment);
        // dump($formData);
        // return; 

        //carico l'immagine di copertina
        if (key_exists("img_url", $formData)) {
            $storageResult = Storage::put("uploads", $formData["img_url"]);
            $newApartment->img_url = $storageResult;
        }
        
        $newApartment->save();

        $newApartment->extra_services()->sync($formData["extraServices"]);
        
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
        $user = Auth::user();
        $userId = Auth::id();

        $data = [
            'apartment' => Apartment::findOrFail($id),
            'user' => $user,
            'userId' => $userId];

        return view('admin.apartments.show', $data);
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
            'extraServices' => $extraServices,
            'userId' => Auth::user()->id,
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
    public function update(Request $request)
    {
        // $request_all = $request->all(); 

        $request->validate([
            'title' => 'required',
            'address_street' => 'required|max:255',
            'street_number' => 'required|max:10',
            'city' => 'required|max:100',
            'zip_code' => 'required|max:10',
            'province' => 'required|max:100',
            'nation' => 'required|max:100',
            'rooms_number' => 'required|integer',
            'beds_number' => 'required|integer',
            'bathrooms_number' => 'required|integer',
            'floor_area' => 'required|numeric',
            'visible' => 'required'
        ]);

        $formData = $request->all();
        
        $apartment = Apartment::findOrFail($formData['apartment_id']);
       

        // dump($request->all());
        // dd($apartment);  
        // return; 

        // $apartment->apartment_id = $formData['apartment_id'];
        if (!key_exists("extraServices", $formData)) {
            $formData["extraServices"] = [];
        }

        $apartment->extra_services()->sync($formData["extraServices"]);

        if (key_exists("img_url", $formData)) {
            
            if ($apartment->img_url) {
                Storage::delete($apartment->img_url);
            }

            $storageResult = Storage::put("img_url", $formData["img_url"]);

            $formData["img_url"] = $storageResult;
        }

        $apartment->update($formData);
        
        // if($formData['user_id'] == $apartment['user_id']) {}

        return redirect()->route('admin.apartments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        //elimina i messaggi collegati all'appartamento
        $apartment->messages()->delete();

        $apartment->extra_services()->detach();

        $apartment->delete();

        return redirect()->route('admin.apartments.index');
    }
}
