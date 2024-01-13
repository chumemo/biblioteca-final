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
        
        if($query == null || $query == '' ) {
            $resultadosPaginados = new Paginator([], 20);
            // return view('busqueda.index' , compact('tiposModelo'));
            return view('busqueda.index' , compact('resultadosPaginados', 'tiposModelo'));
        }

        // // Busquedas anterior por titulo
        // $resultsCapsulas = Capsula::where('titulo', 'like', "%$query%")
        //     ->where('estado', 1)
        //     ->get()->each(function ($item) {
        //     $item->tipo = 1;
        //     $item->link = route('capsula.show', $item->id);
        // });
        // $resultsCatalogos = Catalogo::where('titulo', 'like', "%$query%")
        //     ->where('estado', 1)
        //     ->get()->each(function ($item) {
        //     $item->tipo = 2;
        //     $item->link = route('catalogo.show', $item->id);
        // });
        // $resultsCompendios = Compendio::where('titulo', 'like', "%$query%")
        //     ->where('estado', 1)
        //     ->get()->each(function ($item) {
        //     $item->tipo = 3;
        //     $item->link = route('compendio.show', $item->id);
        // });
        // $resultsFolletos = Folleto::where('titulo', 'like', "%$query%")
        //     ->where('estado', 1)
        //     ->get()->each(function ($item) {
        //     $item->tipo = 4;
        //     $item->link = route('folleto.show', $item->id);
        // });
        // $resultsDocumentos = Documento::where('titulo', 'like', "%$query%")
        //     ->where('estado', 1)
        //     ->get()->each(function ($item) {
        //     $item->tipo = 5;
        //     $item->link = route('documento.show', $item->id);
        // });
        // $resultsFormatos = Formato::where('titulo', 'like', "%$query%")
        //     ->where('estado', 1)
        //     ->get()->each(function ($item) {
        //     $item->tipo = 6;
        //     $item->link = route('formato.show', $item->id);
        // });
        // $resultsManuales = Manual::where('titulo', 'like', "%$query%")
        //     ->where('estado', 1)
        //     ->get()->each(function ($item) {
        //     $item->tipo = 7;
        //     $item->link = route('manual.show', $item->id);
        // });


        // // Buscamos por tema  
        // $resultsCapsulasTemas = Capsula::where('temas', 'like', "%$query%")
        //     ->where('estado', 1)
        //     ->get()->each(function ($item) {
        //     $item->tipo = 1;
        //     $item->link = route('capsula.show', $item->id);
        // });
        // $resultsCatalogosTemas = Catalogo::where('temas', 'like', "%$query%")
        //     ->where('estado', 1)
        //     ->get()->each(function ($item) {
        //     $item->tipo = 2;
        //     $item->link = route('catalogo.show', $item->id);
        // });
        // $resultsCompendiosTemas = Compendio::where('temas', 'like', "%$query%")
        //     ->where('estado', 1)
        //     ->get()->each(function ($item) {
        //     $item->tipo = 3;
        //     $item->link = route('compendio.show', $item->id);
        // });
        // $resultsFolletosTemas = Folleto::where('temas', 'like', "%$query%")
        //     ->where('estado', 1)
        //     ->get()->each(function ($item) {
        //     $item->tipo = 4;
        //     $item->link = route('folleto.show', $item->id);
        // });
        // $resultsDocumentosTemas = Documento::where('temas', 'like', "%$query%")
        //     ->where('estado', 1)
        //     ->get()->each(function ($item) {
        //     $item->tipo = 5;
        //     $item->link = route('documento.show', $item->id);
        // });
        // $resultsFormatosTemas = Formato::where('temas', 'like', "%$query%")
        //     ->where('estado', 1)
        //     ->get()->each(function ($item) {
        //     $item->tipo = 6;
        //     $item->link = route('formato.show', $item->id);
        // });
        // $resultsManualesTemas = Manual::where('temas', 'like', "%$query%")
        //     ->where('estado', 1)
        //     ->get()->each(function ($item) {
        //     $item->tipo = 7;
        //     $item->link = route('manual.show', $item->id);
        // });

        // Busquedas anterior por titulo
        
        $resultsCapsulas = Capsula::where('titulo', 'like', "%$query%")
            ->orWhere('temas', 'like', "%$query%")
            ->where('estado', 1)
            ->get()
            ->each(function ($item) {
                $item->tipo = 1;
                $item->link = route('capsula.show', $item->id);
        });


        $resultsCatalogos = Catalogo::where('titulo', 'like', "%$query%")
            ->orWhere('temas', 'like', "%$query%")
            ->where('estado', 1)
            ->get()->each(function ($item) {
            $item->tipo = 2;
            $item->link = route('catalogo.show', $item->id);
        });
        $resultsCompendios = Compendio::where('titulo', 'like', "%$query%")
            ->orWhere('temas', 'like', "%$query%")
            ->where('estado', 1)
            ->get()->each(function ($item) {
            $item->tipo = 3;
            $item->link = route('compendio.show', $item->id);
        });
        $resultsFolletos = Folleto::where('titulo', 'like', "%$query%")
            // ->orWhere('temas', 'like', "%$query%")
            ->where('estado', 1)
            ->get()->each(function ($item) {
            $item->tipo = 4;
            $item->link = route('folleto.show', $item->id);
        });
        $resultsDocumentos = Documento::where('titulo', 'like', "%$query%")
            ->orWhere('temas', 'like', "%$query%")
            ->where('estado', 1)
            ->get()->each(function ($item) {
            $item->tipo = 5;
            $item->link = route('documento.show', $item->id);
        });
        $resultsFormatos = Formato::where('titulo', 'like', "%$query%")
            // ->orWhere('temas', 'like', "%$query%")
            ->where('estado', 1)
            ->get()->each(function ($item) {
            $item->tipo = 6;
            $item->link = route('formato.show', $item->id);
        });
        $resultsManuales = Manual::where('titulo', 'like', "%$query%")
            ->orWhere('temas', 'like', "%$query%")
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

                        // ->merge($resultsCatalogosTemas)
                        // ->merge($resultsCompendiosTemas)
                        // ->merge($resultsFolletosTemas)
                        // ->merge($resultsDocumentosTemas)
                        // ->merge($resultsFormatosTemas)
                        // ->merge($resultsManualesTemas)

                        ->sortBy('titulo');            
        
        $resultadosPaginados = new Paginator($resultados, 10000);

        // if ($resultados->isEmpty()) {
        //     $resultadosPaginados = new Paginator([], 20);
        // } else {
        //     //$resultadosPaginados = $resultados->paginate(20);
        //     $resultadosPaginados = new Paginator($resultados, 20);
        // }

        


        return view('busqueda.index' , compact('resultadosPaginados', 'tiposModelo'));
    }
}
