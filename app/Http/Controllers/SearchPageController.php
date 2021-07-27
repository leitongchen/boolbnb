<?php

namespace App\Http\Controllers;

use App\Apartment;
use Illuminate\Http\Request;

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
        dd($data); 
        return; 


        $apartments = Apartment::orderBy('updated_at', 'DESC')->get();

    
        return view('search.search', ['apartments' => $apartments]);
    }
}
