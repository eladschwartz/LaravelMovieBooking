<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Stripe_Error;
use App\Reservation;

class StripePaymentController extends Controller
{

      public function stripePost(Request $request)
      {
         $data = $request->all();
         Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

      
        $charge =   Stripe\Charge::create ([
            "amount" => (int)$data['amount'] * 100,
            "currency" => "usd",
            "source" => $data['stripeToken'],
            "description" => "Test payment" 
        ]);
           
         if ($charge['paid'])
         {
            $reservationData = array('user_id' => $data['userID'], 'screening_id' => $data['screeningID'], 'amount' => (int)$data['amount']);
            Reservation::create($reservationData);
        }
        else
        {

        }
    }
}
