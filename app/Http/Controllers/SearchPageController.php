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
        $data = $request->all();

        $apartments = [];
        // $apartments = Apartment::orderBy('updated_at', 'DESC')->get();

        if (count($data) === 0) {

            $apartments = Apartment::orderBy('updated_at', 'DESC')->get();
     
        } else {

            $latitude = $request->latitude;
            $longitude = $request->longitude;
    
            // dd($request);
            // return; 
    
            $radius = 100;
    
            $apartments =  Utilities::radiusSearch($latitude, $longitude, $radius);
    
            // dd($apartments);
            // return; 
        }
    
        return view('search.search', ['apartments' => $apartments]);
    }
}
