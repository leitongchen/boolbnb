<?php

namespace App\Http\Controllers;

use Braintree;
use Illuminate\Http\Request;

class SponsorshipController extends Controller
{
    public function index() 
    {
           
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
    
        $token = $gateway->ClientToken()->generate();
    
        return view('sponsorships.payment', [
            'token' => $token
        ]);

    
    }
}
