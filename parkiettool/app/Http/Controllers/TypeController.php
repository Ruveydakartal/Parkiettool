<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::all();
        return view('order.index', ['types' => $types]);
    }
}

