<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;


class Apartment extends Model
{
    protected $fillable = ['title', 'user_id', 'address_street', 'street_number', 'city', 'zip_code', 'province', 'nation', 'latitude', 'longitude', 'rooms_number', 'beds_number', 'bathrooms_number', 'floor_area', 'img_url', 'visible', 'extra_services_id'];

    public function user() 
    {
        return $this->belongsTo('App\User');
    }

    public function extra_services()
    {
         //argometi per specificare le colonne che erano scritte sbagliatamente
        return $this->belongsToMany(
            'App\Extra_service',
            'apartment_extra_service',
            'apartment_id',
            'extra_services_id'
        );
    }

    public function messages() 
    {
        return $this->hasMany('App\Message');
    }

    public function sponsorships()
    {
        return $this->belongsToMany('App\Sponsorship');
    }

    public function visualizations() 
    {
        return $this->hasMany('App\Visualization');
    }

    public function galleries() 
    {
        return $this->hasMany('App\Gallery');
    }

    //cambia il valore della checkbox in modo che sia leggibile al db
    public function setVisibleAttribute($value)
    {
        $this->attributes['visible'] = ($value=='on');
    }
}
