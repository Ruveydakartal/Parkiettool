<?php

namespace App\Http\Controllers;

use App\Models\Orderitem as ModelsOrderitem;
use Illuminate\Http\Request;
use App\Order;
use App\Ring;
use App\Shipping;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Symfony\Component\CssSelector\Node\SelectorNode;
use Illuminate\Support\Str;
use Mollie\Laravel\Facades\Mollie;

class CheckOutController extends Controller
{
    public function checkout()
    {
        $webhookUrl = route('webhooks.mollie');

        if(App::environment('local')){
            $webhookUrl = 'https://b195-2a02-1812-1415-1e00-75ec-1565-fdad-2010.ngrok-free.app/webhooks/mollie';
        }

        Log::alert('Voor mollie betaling moet de totale prijs berekend worden');

        $order = auth()->user()->orders()
        ->where('status', 'afwachting')
        ->with('orderItems.ring')
        ->first();
        $price = number_format($order->total_price, 2);

    $payment = Mollie::api()->payments()->create([
        "amount" => [
            "currency" => "EUR",
            "value" => $price,
        ],
        "description" => "Order #" . $order->id,
        "redirectUrl" => route('history'),
        "webhookUrl" => $webhookUrl,
      
    ]);

        // Store the Mollie payment ID in your order for reference
        $order->payment_data = $payment->id;
        $order->status = 'Betaald';
        $order->save();

        // Redirect user to Mollie payment page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function succes(){
        return 'jouw bestelling is goed';
    }
}
