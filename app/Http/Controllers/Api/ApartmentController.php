<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Utilities;
use Illuminate\Support\Facades\DB;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::orderBy('updated_at', 'DESC')->get();

        return response()->json([
            'success' => true,
            'results' => $apartments,
        ]);
    }

//     SELECT * 
// FROM `apartments`	 
// JOIN `apartment_extra_service`
// 	ON `apartments`.id = `apartment_extra_service`.`apartment_id`
// WHERE `apartment_extra_service`.`extra_services_id` = 4
//  AND `beds_number` > 1 

    public function filter(Request $request)
    {
        $filters = $request->only(["rooms_number", "bathrooms_number", "extra_services"]);
        
        $positionData = $request->only(["query", "position", "radius"]);

        $query = $positionData['query'];
        $position = json_decode($positionData['position']);

        $latitude = $position->lat;
        $longitude = $position->lng;
        $radius = $positionData['radius'];

        $result = Utilities::radiusSearch($latitude, $longitude, $radius)->with('extra_services');
        
        
        // Apartment::select(DB::raw("id, title, address_street, street_number, city, zip_code, province, nation, latitude, longitude, rooms_number, beds_number, bathrooms_number, floor_area, img_url, visible,
        // ( 6371 * acos( cos( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance"))
        //     ->havingRaw('distance <' . $radius)
        //     ->orderBy('distance')
        //     ->with('extra_services');   

        // Utilities::radiusSearch($latitude, $longitude, $radius);

        foreach ($filters as $filter => $value) {

            if ($filter === "extra_services") {

                if (!is_array($value)) {
                    $value = explode(",", $value);
                }

                $result->join("apartment_extra_service", "apartments.id", "=", "apartment_extra_service.apartment_id")
                    ->whereIn("apartment_extra_service.extra_services_id", $value);

            } else {
                $result->where($filter, ">", $value);
            }
        }

        $apartments = $result->get();

        // foreach ($apartments as $apartment) {
        //     $apartment->img_url = $apartment->img_url ? asset('storage/' .$apartment->img_url) : "https://www.linga.org/site/photos/Largnewsimages/image-not-found.png";
        // }
        return response()->json([
            "success" => true,
            "filters" => $filters,
            "query" => $result->getQuery()->toSql(),
            "results" => $apartments,
            "latitude" => $latitude,
            "longitude" => $longitude,
            "radius" => $radius,

          ]);
    }
}
