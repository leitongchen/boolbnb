<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $now = Carbon::now()->toDateTimeString(); 

        $sponsoredApartments = Apartment::
                join("apartment_sponsorship", "apartments.id", "=", "apartment_sponsorship.apartment_id")  
                ->where('end_at', '>', $now)
                ->with('sponsorships')
                ->get(); 


        $data = [
            "sponsored" => $sponsoredApartments,
            "apartments" => Apartment::orderBy('updated_at', 'DESC')->paginate(10),
        ];
        

        return view('home', $data);
    }
}

// $hours = $el->sponsorships[0]->promo_hours;

// if ($hours == 24) {

//     $el->end_at = Carbon::createFromFormat('Y-m-d H:i:s', $el->start_at)->addHours(24);

// } else if ($hours == 72) {

//     $el->end_at = Carbon::createFromFormat('Y-m-d H:i:s', $el->start_at)->addHours(72);

// } else if ($hours == 144) {

//     $el->end_at = Carbon::createFromFormat('Y-m-d H:i:s', $el->start_at)->addHours(144);
// }