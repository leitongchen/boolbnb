<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use App\Extra_service;
use App\Http\Controllers\Controller;
use Dotenv\Exception\ValidationException;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $userApartments = Apartment::orderBy('updated_at', 'DESC')->where('user_id', '=', $userId)->get();
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
        $formData = $request->all();

        // $dataArr = new Request([
        //     'title' => $request->title,
        //     'address_street' => $request->address_street,
        //     'street_number' => $request->street_number,
        //     'city' => $request->city,
        //     'zip_code' => $request->zip_code,
        //     'province' => $request->province,
        //     'nation' => $request->nation,
        //     'rooms_number' => $request->rooms_number,
        //     'beds_number' => $request->beds_number,
        //     'bathrooms_number' => $request->bathrooms_number,
        //     'floor_area' => $request->floor_area,
        //     'img_url' => $request->img_url,
        // ]);

        // dump($request);
        // dump($request->title);
        // dump($request->address_street);
        // dump($dataArr);
        // return; 

        // $request->validate([
        //     'title' => 'required',
        //     'address_street' => 'required|max:255|min:2',
        //     'street_number' => 'required|max:10',
        //     'city' => 'required|max:100|min:2',
        //     'zip_code' => 'required|max:10',
        //     'province' => 'required|max:100|min:2',
        //     'nation' => 'required|max:100|min:2',
        //     'rooms_number' => 'required|integer|min:1',
        //     'beds_number' => 'required|integer|min:1',
        //     'bathrooms_number' => 'required|integer|min:1',
        //     'floor_area' => 'required|numeric|min:10',
        //     'img_url' => 'required',
        // ]);
  
        // dump($request->all());
        // dump($request->user_id);
        // return; 

        $newApartment = new Apartment;
        
        $newApartment->fill($formData);
        $newApartment->user_id = $request->user_id;

        // dump($newApartment);
        // dump($formData);
        // return; 

        //carico l'immagine di copertina
        if (key_exists("img_url", $formData)) {
            $storageResult = Storage::put("uploads", $formData["img_url"]);
            $newApartment->img_url = $storageResult;
        }
        
        $newApartment->save();

        if (isset($formData["extraServices"])) {
            $newApartment->extra_services()->sync($formData["extraServices"]);
        }
        
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

        $apartment = Apartment::findOrFail($id);

        $data = [
            'apartment' => $apartment,
            'user' => $user,
            'userId' => $userId
        ];
            
        
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
        ]);

        $formData = $request->all();
        
        $apartmentId = (int)$request->apartment_id;

        $apartment = Apartment::findOrFail($apartmentId);

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
