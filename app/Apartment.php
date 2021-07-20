<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = ['title', 'user_id', 'address_street', 'street_number', 'city', 'zip_code', 'province', 'nation', 'latitude', 'longitude', 'rooms_number', 'beds_number', 'bathrooms_number', 'floor_area', 'img_url', 'visible'];
}
