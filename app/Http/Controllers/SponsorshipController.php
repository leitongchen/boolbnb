<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Sponsorship;
use Braintree;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SponsorshipController extends Controller
{
    public function index() 
    {

        $userId = Auth::user()->id; 
        $apartments = Apartment::orderBy('updated_at', 'DESC')->where('user_id', '=', $userId)->get();

        $sponsorships = Sponsorship::all(); 

        // dump($sponsorships);
        // return; 
        
        foreach($apartments as $apartment) {

            $completeAddress = [];

            $completeAddress[] = $apartment->address_street;
            $completeAddress[] = $apartment->street_number;
            $completeAddress[] = $apartment->city;
            $completeAddress[] = $apartment->province;

            $apartment->completeAddress = implode(', ', $completeAddress);
        }

        // dump($apartments);


        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
    
        $token = $gateway->ClientToken()->generate();
    
        return view('sponsorships.payment', [
            'token' => $token,
            'apartments' => $apartments,
            'sponsorships' => $sponsorships,
        ]);

    }

    public function checkout (Request $request) 
    {
        $user = Auth::user(); 
        $apartmentId = $request->apartment_id;
        $apartment = Apartment::where('id', '=', $apartmentId)->get();

        $sponsorshipId = $request->sponsorship_id;
        $sponsorshipDetail = Sponsorship::where('id', '=', $sponsorshipId)->get();

        // dump($request);
        // dump($sponsorshipDetail);
        // dump($sponsorshipDetail[0]->price);

        // dump($apartment[0]->title);
        // return; 

        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        

        $amount = $sponsorshipDetail[0]->price;
        $nonce = $request->payment_method_nonce;
    
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'customer' => [
                'id' => $user->id,
                'firstName' => $user->name,
                'lastName' => $user->surname,
                'email' => $user->email,
            ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        // dd($result);
        // return; 
    
        if ($result->success) {
            $transaction = $result->transaction;
            // header("Location: transaction.php?id=" . $transaction->id);

            // dump($transaction);
            // return; 

            //FARE SYNC DELLA SPONSORIZZAZIONE 

            $apartment[0]->sponsorships()->sync([$sponsorshipDetail[0]->id => ['start_at' => Carbon::now()]]);
    
            return back()->with('success_message', 'Transaction successful. The ID is:'. $transaction->id . '. You paid '. $transaction->amount . '€' );
        } else {
            $errorString = "";
    
            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
    
            // $_SESSION["errors"] = $errorString;
            // header("Location: index.php");
            return back()->withErrors('An error occurred with the message: '.$result->message);
        }
    }
}
