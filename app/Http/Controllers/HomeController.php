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
        $start_search = Carbon::now()->subHours(144)->toDateTimeString();

        // resultsList contain a list of apartments where had promotions in the last 144hours
        $resultsList = Apartment::
                join("apartment_sponsorship", "apartments.id", "=", "apartment_sponsorship.apartment_id")  
                ->whereBetween('start_at', [$start_search, $now])
                ->with('sponsorships')
                ->get(); 

        // this array will contain all the apartments with still active promotion
        // sponsored apartments will be pushed after saving end_at date and checked if isPast or not
        $sponsoredApartments = [];
                
        foreach ($resultsList as $el) {
            
            $hours = $el->sponsorships[0]->promo_hours;

            if ($hours == 24) {

                $el->end_at = Carbon::createFromFormat('Y-m-d H:i:s', $el->start_at)->addHours(24);

            } else if ($hours == 72) {

                $el->end_at = Carbon::createFromFormat('Y-m-d H:i:s', $el->start_at)->addHours(72);

            } else if ($hours == 144) {

                $el->end_at = Carbon::createFromFormat('Y-m-d H:i:s', $el->start_at)->addHours(144);
            }

            if (!$el->end_at->isPast()) {

                $sponsoredApartments[] = $el; 
            }
        }

        $data = [
            "sponsored" => $sponsoredApartments,
            "apartments" => Apartment::orderBy('updated_at', 'DESC')->get(),
        ];
        

        return view('home', $data);
    }
}
