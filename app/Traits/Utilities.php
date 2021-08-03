<?php 


namespace app\Traits;
use Illuminate\Support\Str;
use App\Apartment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait Utilities  
{

    static public function radiusSearch($latitude, $longitude, $radius) 
    {
        $apartments = Apartment::select(DB::raw("id, title, address_street, street_number, city, zip_code, province, nation, latitude, longitude, rooms_number, beds_number, bathrooms_number, floor_area, img_url, visible,
        ( 6371 * acos( cos( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance"))
            ->havingRaw('distance <' . $radius)
            ->orderBy('distance');     

        return $apartments; 
    }

}
