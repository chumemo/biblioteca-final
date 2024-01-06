<?php

namespace App\Http\Controllers;

use App\Models\Compendio;
use App\Models\Autoridad;
use App\Models\Criterio;
use App\Models\Tema;


use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CompendioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index(Request $request)
    {
        $criterios = Criterio::all();
        $autoridades = Autoridad::all();
        $temas = Tema::all();
        $compendios = Compendio::where('estado', 1)
            ->orderByDesc('anio')
            ->paginate(20);
        
        return view("compendio.index", compact("compendios", "criterios", "autoridades" , "temas"));
    }
    public function admin()
    {
        $compendios = Compendio::orderByDesc('created_at')
            ->paginate(20);
        $temas = Tema::all();
        // $id=1
        // buscar en $temas el tema con id = $id
        // $tema = $temas->find($id);

        return view('compendio.admin', compact('compendios','temas'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $criterios = Criterio::all();
        $autoridades = Autoridad::all();
        $temas = Tema::all();
        return view('compendio.create', compact('autoridades', 'criterios', "temas"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $compendio = new Compendio();

        $compendio->titulo = $request->titulo;
        $compendio->descripcion = $request->descripcion;
        $compendio->anio = $request->anio;
        $compendio->estado = $request->estado;
        $compendio->autoridad = $request->autoridad;
        $compendio->criterio = $request->criterio;

        $compendio->tema = $request->tema;

        $compendio->autorId = $request->user()->id;

        if ($request->hasFile("urlImagen")) {
            $file = $request->file("urlImagen");

            $name = time() . "-" . $request->file("urlImagen")->getClientOriginalName();
            $name = str_replace(" ", "-", $name);

            $file->storeAs("public/compendios/", $name);

            $imagePath = storage_path("app/public/compendios/" . $name);
            $resizedImage = Image::make($imagePath)->fit(320, 320);
            $resizedImage->save(storage_path("app/public/compendios/" . $name));
            $compendio->urlImagen = "storage/compendios/" . $name;
        } else {
            $compendio->urlImagen = "assets/img/ICONO-Documentos.png";
        }


        if ($request->hasFile("urlDocumento")) {
            $file = $request->file("urlDocumento");

            $name = time() . "-" . $request->file("urlDocumento")->getClientOriginalName();
            $name = str_replace(" ", "-", $name);

            $file->storeAs("public/compendios/", $name);

            $compendio->urlDocumento = "storage/compendios/" . $name;
            
            $compendio->nombreArchivo = $name;
        }

        $compendio->save();

        return redirect()->route('compendio.admin');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $compendio = Compendio::find($id);

        if (!$compendio) {
            abort(404);
        }

        return view('compendio.show', compact('compendio'));    
    
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(string $id)
    {
        $compendio = Compendio::find($id);
        $autoridades = Autoridad::all();
        $criterios = Criterio::all();
        $temas = Tema::all();

        return view('compendio.edit', compact('compendio', 'autoridades', 'criterios','temas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $compendio = Compendio::find($id);
        $compendio->titulo = $request->titulo;
        $compendio->descripcion = $request->descripcion;
        $compendio->anio = $request->anio;
        $compendio->estado = $request->estado;
        $compendio->autoridad = $request->autoridad;
        $compendio->criterio = $request->criterio;

        $compendio->tema = $request->tema;

        $compendio->autorId = $request->user()->id;

        if ($request->hasFile("urlImagen")) {
            $file = $request->file("urlImagen");

            $name = time() . "-" . $request->file("urlImagen")->getClientOriginalName();
            $name = str_replace(" ", "-", $name);

            $file->storeAs("public/compendios/", $name);

            $imagePath = storage_path("app/public/compendios/" . $name);
            $resizedImage = Image::make($imagePath)->fit(320, 320);
            $resizedImage->save(storage_path("app/public/compendios/" . $name));
            $compendio->urlImagen = "storage/compendios/" . $name;
        } else {
            $compendio->urlImagen = "assets/img/ICONO-Documentos.png";
        }


        if ($request->hasFile("urlDocumento")) {
            $file = $request->file("urlDocumento");

            $name = time() . "-" . $request->file("urlDocumento")->getClientOriginalName();
            $name = str_replace(" ", "-", $name);

            $file->storeAs("public/compendios/", $name);

            $compendio->urlDocumento = "storage/compendios/" . $name;
        }

        $compendio->save();
        return redirect()->route('compendio.admin');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $compendio = Compendio::find($id);
        $compendio->delete();
        return redirect()->route('compendio.admin');
    }
}
