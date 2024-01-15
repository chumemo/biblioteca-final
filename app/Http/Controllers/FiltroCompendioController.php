<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compendio;
use App\Models\Criterio;
use App\Models\Autoridad;
use App\Models\Tema;
use Illuminate\Support\Facades\Session;

class FiltroCompendioController extends Controller
{

    public function index(Request $request)
    {
        // $criterios = Criterio::all();
        // $autoridades = Autoridad::all();
        // $temas = Tema::all();

        // if($this->compendiosGlobal == null){
        //     $this->compendiosGlobal = Compendio::where('estado', 1)
        //     ->orderByDesc('anio')
        //     ->paginate(4);
        // }

        // $compendios = $this->compendiosGlobal;

        // return view("compendio.index", compact("compendios", "criterios", "autoridades" , "temas"));



        $autoridad = Session::get('autoridad') ;
        $anio = Session::get('anio') ;
        $criterio = Session::get('criterio') ;
        $tema = Session::get('tema') ;
    
        $query = Compendio::query();

        if ($tema !== null) {
            $query->where('temas', 'like', "%$tema%");            
        }

        if ($autoridad !== null) {
            $query->where('autoridad', $autoridad);
        }

        if ($criterio !== null) {
            $query->where('criterio', $criterio);
        }

        if ($anio !== null) {
            $query->where('anio', $anio);
        }
        
        $query->where('estado', '1');
        
        $compendios = $query->paginate(20);
        
        $criterios = Criterio::all();
        $autoridades = Autoridad::all();
        $temas = Tema::all();

        return view('compendio.index', compact('compendios', 'autoridades', 'criterios','temas'));

    }

    public function filtrarDatos(Request $request)
    {
        $autoridad = $request->input('autoridad', null);
        $anio = $request->input('anio', null);
        $criterio = $request->input('criterio', null);
        $tema = $request->input('tema', null);
    
        $query = Compendio::query();

        if ($tema !== null) {
            // $query->where('tema', $tema);
            $query->where('temas', 'like', "%$tema%");            
        }

        if ($autoridad !== null) {
            $query->where('autoridad', $autoridad);
        }

        if ($criterio !== null) {
            $query->where('criterio', $criterio);
        }

        if ($anio !== null) {
            $query->where('anio', $anio);
        }
        
        $query->where('estado', '1');
        
        $compendios = $query->paginate(20);
        
        // asignar a variable global compendiosGlobal el valor de $compendios
        $this->compendiosGlobal = $compendios;      
        
        // params
        Session::put('tema', $tema);
        Session::put('autoridad', $autoridad);
        Session::put('criterio', $criterio);
        Session::put('anio', $anio);



        $criterios = Criterio::all();
        $autoridades = Autoridad::all();
        $temas = Tema::all();

        return view('compendio.index', compact('compendios', 'autoridades', 'criterios','temas'));
    }
}
