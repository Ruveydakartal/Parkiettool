<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Order;
use Illuminate\Support\Facades\Auth;

class OrdersExport implements FromCollection

{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        if ($this->startDate && $this->endDate) {
            // Get orders associated with the authenticated user within the selected date range
            $userOrders = Order::all()
                ->whereBetween('created_at', [$this->startDate, $this->endDate]);
        } else {
            $userOrders = Order::all();
        }
        
        // Create a collection to store the order data
        $data = collect();

        // Loop through each order to extract information
        foreach ($userOrders as $order) {
            $orderData = [
                'Bestelling' => $order->id,
                'Stamnr' => $order->user->stamnr,
                'Naam' => $order->user->firstname . ' ' . $order->user->lastname,
                'Adres' => $order->user->adress_street . ' ' . $order->user->adress_number,
                'Zip' => $order->user->adress_zipcode,
                'Stad' => $order->user->adress_city,
                'Telefoon' => $order->user->phone,
                'Totaal' => $order->total_price,
                'Status' => $order->status,
                'Datum' => $order->updated_at,
            ];

            $data->push($orderData);
        }

        return $data;
    }
}