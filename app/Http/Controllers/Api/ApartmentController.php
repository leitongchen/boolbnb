<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function filter(Request $request)
    {
        $filters = $request->only(["rooms_number", "bathrooms_number", "extra_services"]);

        $result = Apartment::with("extra_services");

        foreach ($filters as $filter => $value) {
            if ($filter === "extra_services") {
                if (!is_array($value)) {
                    $value = explode(",", $value);
                }

                $result->join("apartment_extra_service", "apartments.id", "=", "apartment_extra_service.apartments.id")
                    ->whereIn("apartment_extra_service.apartments.id", $value);
            } else {
                $result->where($filter, "LIKE", "%value%");
            }
        }

        $apartments = $result->get();

        foreach ($apartments as $apartment) {
            $apartment->img_url = $apartment->img_url ? asset('storage/' .$apartment->img_url) : "https://www.linga.org/site/photos/Largnewsimages/image-not-found.png";
        }
        return response()->json([
            "success" => true,
            "filters" => $filters,
            "query" => $result->getQuery()->toSql(),
            "results" => $apartments
          ]);
    }
}
