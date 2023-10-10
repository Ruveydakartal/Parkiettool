<?php

namespace App\Http\Controllers;

use App\Models\Orderitem as ModelsOrderitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\Ring;
use App\Shipping;
use App\Models\OrderItem;
use App\Models\User;
use Symfony\Component\CssSelector\Node\SelectorNode;
use Illuminate\Support\Str;

class CartController extends Controller

{
 
    public function addToCart(Request $request)
    {
        $request->validate([
            'ring_id' => 'required|exists:rings,id', 
            'amount' => 'required|integer',
        ]);

        $ring = Ring::findOrFail($request->ring_id);

        $order = auth()->user()->orders()->firstOrCreate(['status' => 'afwachting']);

        $orderItem = new OrderItem([
            'amount' => $request->amount,
            'price' => $ring->price,
        ]);

        $ring->orderItems()->save($orderItem);
        $order->orderItems()->save($orderItem);

        return redirect()->route('cart')->with('success', 'Item added to cart successfully!');
    }

    public function index()
{
    if(!Auth::check()) {
        return redirect()->route('login');
    }else{
    
    $user = auth()->user();
    $userDetails = User::where('id', $user->id)->first();
    $userAdress = $userDetails->address_street;
    $userNumber = $userDetails->address_number;
    $userCity = $userDetails->adress_city;
    $userZipcode = $userDetails->adress_zipcode;


    $shippingOptions = Shipping::all();

    $order = auth()->user()->orders()
        ->where('status', 'afwachting')
        ->with('orderItems.ring') // connectie met de ringen
        ->first();

    $selectedShippingOption = null;
    $totalPrice = 0;

    $referenceCode = Str::random(10);

    if ($order) {
        foreach ($order->orderItems as $orderItem) {
            $totalPrice += $orderItem->ring->price * $orderItem->amount;
        }

        // shipping opties tonen + default shipping optie en prijs
        if ($order->shipping_data) {
            $selectedShippingOption = Shipping::find($order->shipping_data);
            $totalPrice += $selectedShippingOption->price;
        }else{
            $selectedShippingOption = Shipping::find(1);
            $totalPrice += $selectedShippingOption->price;
        }
        
        $order->total_price = $totalPrice;
        $order->reference = $referenceCode;
        $order->save();

    }
    }

    return view('cart', compact('order', 'totalPrice', 'shippingOptions', 'selectedShippingOption', 'userAdress', 'userNumber', 'userCity', 'userZipcode'));
}


    public function remove(OrderItem $orderItem)
    {
        $orderItem->delete();

        return redirect()->route('cart')->with('success', 'Item removed from cart.');
    }

    public function updateShipping(Request $request)
{
    $request->validate([
        'shipping_option' => 'required|exists:shippings,id',
    ]);

    $order = auth()->user()->orders()
        ->where('status', 'afwachting')
        ->first();

    if ($order) {
        $selectedShippingOption = Shipping::find($request->shipping_option);

        if ($selectedShippingOption) {
            $order->shipping_data = $selectedShippingOption->id; // id voor connectie
            $order->admin_remarks = $selectedShippingOption->name; // info voor admin
            $order->save();
        }
    }

    return redirect()->route('cart')->with('success', 'Shipping option updated successfully!');
}

public function checkOut()
{
    $order = auth()->user()->orders()
        ->where('status', 'afwachting')
        ->with('orderItems.ring') 
        ->first();
    
    return view('checkout');
}

   

    
}
