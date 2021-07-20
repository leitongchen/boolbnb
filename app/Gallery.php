<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public function apartment() 
    {
        return $this->belongsTo('App\Apartment');
    }
}
