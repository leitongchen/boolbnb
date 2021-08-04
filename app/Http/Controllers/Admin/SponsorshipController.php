<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use App\Http\Controllers\Controller;
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
        $allApartments = Apartment::orderBy('updated_at', 'DESC')
            ->where('user_id', '=', $userId)
            ->with('sponsorships')
            ->get();

        $now = Carbon::now()->toDateTimeString(); 

        $sponsoredApartments = Apartment::where('user_id', '=', $userId)
            ->join("apartment_sponsorship", "apartments.id", "=", "apartment_sponsorship.apartment_id")
            ->where('end_at', '>', $now)
            ->get();

        $sponsorships = Sponsorship::all(); 

        //set new temporary column containing a string of the complete address
        foreach($allApartments as $apartment) {
            $completeAddress = [];

            $completeAddress[] = $apartment->address_street;
            $completeAddress[] = $apartment->street_number;
            $completeAddress[] = $apartment->city;
            $completeAddress[] = $apartment->province;

            $apartment->completeAddress = implode(', ', $completeAddress);
        }
        
        // apartments that have not already sponsorships active
        $apartments = $allApartments->diff($sponsoredApartments);

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
        
        // dump(Carbon::now());
        // dump(Carbon::now()->addHours(24));
        // return; 

        $amount = $sponsorshipDetail[0]->price;
        $hours = $sponsorshipDetail[0]->promo_hours;
        $nonce = $request->payment_method_nonce;

        // dump($nonce);
        // dump($request);
        // return; 
    
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

            //FARE SYNC DELLA SPONSORIZZAZIONE 
            // salvare la data di fine della sponsorizzazione in db end_at
            $apartment[0]->sponsorships()->sync([$sponsorshipDetail[0]->id => ['end_at' => Carbon::now()->addHours($hours)]]);
    
            // return redirect()->route('index')->with('success_message', 'Transaction successful. The ID is:'. $transaction->id . '. You paid € '. $transaction->amount);

            return back()->with('success_message', 'Transaction successful. The ID is:'. $transaction->id . '. You paid € '. $transaction->amount);
        } else {
            $errorString = "";
    
            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
    
            // $_SESSION["errors"] = $errorString;
            // header("Location: index.php");
            // return redirect()->route('index')->withErrors('An error occurred with the message: '.$result->message);
            return back()->withErrors('An error occurred with the message: '.$result->message);

        }
    }
}
