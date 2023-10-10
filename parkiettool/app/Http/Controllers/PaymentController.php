<?php

namespace App\Http\Controllers;

use App\Models\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Mollie\Laravel\Facades\Mollie;

class PaymentController extends Controller
{
    public function checkout()
    {
        $webhookUrl = route('webhooks.mollie');

        if(App::environment('local')){
            $webhookUrl = 'https://b195-2a02-1812-1415-1e00-75ec-1565-fdad-2010.ngrok-free.app/webhooks/mollie';
        }

        Log::alert('Voor mollie betaling moet de totale prijs berekend worden');

       $price = "30.00";

    $payment = Mollie::api()->payments()->create([
        "amount" => [
            "currency" => "EUR",
            "value" => $price,
        ],
        "description" => "Jaarlijkse betaling" ,
        "redirectUrl" => route('profile.edit'),
        "webhookUrl" => $webhookUrl,
      
    ]);

    UserStatus::create([
        'user_id' => auth()->user()->id,
        'status' => 'Betaald',
        'date' => date('Y-m-d'),
        'payment_data' => $payment->id,
    ]);

    return redirect($payment->getCheckoutUrl(), 303);
}
}