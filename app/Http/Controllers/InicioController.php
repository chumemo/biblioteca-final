<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capsula;

class InicioController extends Controller
{
    public function index()
    {
        $cantidad = 6;
        $capsulas = Capsula::latest()->take($cantidad)->get();

        return view('inicio', compact('capsulas'));
    }
}
