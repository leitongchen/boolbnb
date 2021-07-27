<?php

namespace App\Http\Controllers;

use App\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $data = $request->all();

        $apartments = [];

        if (!isset($data)) {

            $apartments = Apartment::orderBy('updated_at', 'DESC')->get();
        }

        // dd($data);
        // dump($request->latitude);
        // return; 

        $latitude = $request->latitude;
        $longitude = $request->longitude;

        // dd($data['latitude']);
        // return; 

        $km = 20;

        $apartments = Apartment::select(DB::raw("id, title, address_street, street_number, city, zip_code, province, nation, latitude, longitude, rooms_number, beds_number, bathrooms_number, floor_area, img_url, visible,
        ( 6371 * acos( cos( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance"))
            ->havingRaw('distance <' . $km)
            ->orderBy('distance')
            ->get();         

        // dd($apartments);
        // return; 
    
        return view('search.search', ['apartments' => $apartments]);
    }
}
