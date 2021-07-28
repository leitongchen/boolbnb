<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['sender_name', 'sender_surname', 'phone_number', 'sender_mail', 'content', 'updated_at', 'created_at', 'apartment_id'];
    
    public function apartment() 
    {
        return $this->belongsTo('App\Apartment');
    }
}
