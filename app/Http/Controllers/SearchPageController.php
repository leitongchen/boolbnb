<?php

namespace App\Http\Controllers;

use App\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\Utilities; 

class SearchPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $incomingData = $request->all();

        // dd($request->all());
        // return;

        $apartments = [];
        $latitude = null;
        $longitude = null; 

        
        // $data = [];

        if (count($incomingData) === 0) {


            $latitude = 41.8719;
            $longitude = 12.5674;
            $query = "";
            $apartments = Apartment::orderBy('updated_at', 'DESC')->get();


            // dump($latitude);
            // return;
     
        } else {

            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $radius = 20;
            $query = $request['query'];

            $apartments =  Apartment::select(DB::raw("id, title, address_street, street_number, city, zip_code, province, nation, latitude, longitude, rooms_number, beds_number, bathrooms_number, floor_area, img_url, visible,
            ( 6371 * acos( cos( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance"))
                ->havingRaw('distance <' . $radius)
                ->orderBy('distance')
                ->get();   


        }
    
        return view('search.search', [
            "apartments" => $apartments,
            "latitude" => $latitude,
            "longitude" => $longitude,
            "query" => $query
        ]);
    }
}
