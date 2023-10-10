<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ring;
use App\Type;

class RingController extends Controller
{
    public function index()
        {
        $types = Type::all();
        $aluRingen = Ring::where('type_id', 3)->get();
        $rvsRingen = Ring::where('type_id', 1)->get();
        return view('order.index', compact('aluRingen','rvsRingen'));
        }

        public function types()
        {
            // ringen met typen
            $typesWithRings = Type::with('rings')->get();
            
            return view('order.index', ['typesWithRings' => $typesWithRings]);
        }
}
