<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Capsula;
use App\Models\Catalogo;
use App\Models\Compendio;
use App\Models\Folleto;
use App\Models\Documento;
use App\Models\Formato;
use App\Models\Manual;





class BusquedaController extends Controller
{
    public function index(Request $request) {

        $tiposModelo = [ 
            1 => 'Capsula',
            2 => 'Catalogo',
            3 => 'Compendio',
            4 => 'Folleto',
            5 => 'Documento',
            6 => 'Formato',
            7 => 'Manual',
        ];
        
        $query = $request->input('query');
        
        $resultsCapsulas = Capsula::where('titulo', 'like', "%$query%")
            ->where('estado', 1)
            ->get()->each(function ($item) {
            $item->tipo = 1;
            $item->link = route('capsula.show', $item->id);
        });
        $resultsCatalogos = Catalogo::where('titulo', 'like', "%$query%")
            ->where('estado', 1)
            ->get()->each(function ($item) {
            $item->tipo = 2;
            $item->link = route('catalogo.show', $item->id);
        });
        $resultsCompendios = Compendio::where('titulo', 'like', "%$query%")
            ->where('estado', 1)
            ->get()->each(function ($item) {
            $item->tipo = 3;
            $item->link = route('compendio.show', $item->id);
        });
        $resultsFolletos = Folleto::where('titulo', 'like', "%$query%")
            ->where('estado', 1)
            ->get()->each(function ($item) {
            $item->tipo = 4;
            $item->link = route('folleto.show', $item->id);
        });
        $resultsDocumentos = Documento::where('titulo', 'like', "%$query%")
            ->where('estado', 1)
            ->get()->each(function ($item) {
            $item->tipo = 5;
            $item->link = route('documento.show', $item->id);
        });
        $resultsFormatos = Formato::where('titulo', 'like', "%$query%")
            ->where('estado', 1)
            ->get()->each(function ($item) {
            $item->tipo = 6;
            $item->link = route('formato.show', $item->id);
        });
        $resultsManuales = Manual::where('titulo', 'like', "%$query%")
            ->where('estado', 1)
            ->get()->each(function ($item) {
            $item->tipo = 7;
            $item->link = route('manual.show', $item->id);
        });

        
        $resultados = $resultsCapsulas
                        ->merge($resultsCatalogos)
                        ->merge($resultsCompendios)
                        ->merge($resultsFolletos)
                        ->merge($resultsDocumentos)
                        ->merge($resultsFormatos)
                        ->merge($resultsManuales)
                        ->sortBy('titulo');
        
        $resultadosPaginados = new Paginator($resultados, 20);
        return view('busqueda.index' , compact('resultadosPaginados', 'tiposModelo'));
    }
}
