<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class HistoryController extends Controller
{
    public function index( Request $request)
    {
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate && $endDate) {
            // als er datums worden ingegeven, dan filteren we op die datums
            $orders = Order::all()
                ->whereBetween('created_at', [$startDate, $endDate]);
        }elseif(Auth::id() == 1){
        $orders= Order::all();
        }
        else{
        $orders= Order::where('user_id', Auth::id())->get();
        }

        return view('history', compact('orders', 'startDate', 'endDate'));
    }


    public function downloadPDF(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
        ]);
        
        $orderId = $request->input('order_id'); 
     
        $order = Order::where('user_id', Auth::id())
                ->findOrFail($orderId);
       
        $pdf = PDF::loadView('pdf', ['order' => $order]);

      
        return $pdf->download('order_'.$orderId.'.pdf');
    }

    public function exportOrders(Request $request)
    {
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);
        
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate && $endDate) {
            // Create an instance of OrdersExport with start and end dates
            $export = new OrdersExport($startDate, $endDate);
        } else {
            // Create an instance of OrdersExport without any date filtering
            $export = new OrdersExport();
        }

        // Download the Excel file
        return Excel::download($export, 'orders.xlsx');
    }

}
