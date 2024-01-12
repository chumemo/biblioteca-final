<?php

namespace App\Http\Controllers;

use App\Models\Catalogo;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Tema;

class CatalogoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catalogos = Catalogo::where('estado', '1')
        ->orderByDesc('fecha')
        ->paginate(12);
        return view("catalogo.index", compact("catalogos"));
    }

    public function admin()
    {
        $catalogos = Catalogo::orderByDesc('created_at')
            ->paginate(10);
        return view("catalogo.admin", compact("catalogos"));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $temas = Tema::all();
        return view("catalogo.create", compact("temas"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $catalogo = new Catalogo();

        $catalogo->titulo = $request->titulo;
        $catalogo->fecha = $request->fecha;
        $catalogo->estado = $request->estado;
        $catalogo->autorId = $request->user()->id;

        $catalogo->temas = $request->temas;

        if ($request->hasFile("urlImagen")) {
            $file = $request->file("urlImagen");

            $name = time() . "-" . $request->file("urlImagen")->getClientOriginalName();
            $name = str_replace(" ", "-", $name);

            $file->storeAs("public/documentos/", $name);

            $imagePath = storage_path("app/public/documentos/" . $name);
            $resizedImage = Image::make($imagePath)->fit(320, 320);
            $resizedImage->save(storage_path("app/public/documentos/" . $name));
            $catalogo->urlImagen = "storage/documentos/" . $name;
        } else {
            $catalogo->urlImagen = "assets/img/ICONO-Catalogo.png";
        }

        if ($request->hasFile("urlDocumento")) {
            $file = $request->file("urlDocumento");

            $name = time() . "-" . $request->file("urlDocumento")->getClientOriginalName();
            $name = str_replace(" ", "-", $name);
            
            $file->storeAs("public/manuales/" , $name);
    
        $catalogo->urlDocumento = "storage/manuales/" . $name;

        $catalogo->nombreArchivo = $name;
        
    }
    
    $catalogo->save();
    

        return redirect()->route('catalogo.admin');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $catalogo = Catalogo::find($id);

        // Verifica si el catalogo existe
        if (!$catalogo) {
            abort(404);
        }

        return view('catalogo.show', compact('catalogo'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $catalogo = Catalogo::findOrFail($id);
        $temas = Tema::all();
        return view("catalogo.edit", compact("catalogo", "temas"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $catalogo = Catalogo::findOrFail($id);
        $catalogo->titulo = $request->titulo;
        $catalogo->fecha = $request->fecha;
        $catalogo->estado = $request->estado;

        $catalogo->temas = $request->temas;
        

        if ($request->hasFile("urlImagen")) {
            $file = $request->file("urlImagen");

            $name = time() . "-" . $request->file("urlImagen")->getClientOriginalName();
            $name = str_replace(" ", "-", $name);

            $file->storeAs("public/documentos/", $name);

            $imagePath = storage_path("app/public/documentos/" . $name);
            $resizedImage = Image::make($imagePath)->fit(320, 320);
            $resizedImage->save(storage_path("app/public/documentos/" . $name));
            $catalogo->urlImagen = "storage/documentos/" . $name;
        } else {
            $catalogo->urlImagen = "assets/img/ICONO-Catalogo.png";
        }

        if ($request->hasFile("urlDocumento")) {
            $file = $request->file("urlDocumento");

            $name = time() . "-" . $request->file("urlDocumento")->getClientOriginalName();
            $name = str_replace(" ", "-", $name);
            
            $file->storeAs("public/manuales/" , $name);
    
        $catalogo->urlDocumento = "storage/manuales/" . $name;

        $catalogo->nombreArchivo = $name;

        }

        $catalogo->save();
        return redirect()->route('catalogo.admin');
    }

    public function destroy(string $id)
    {
        $catalogo = Catalogo::find($id);
        $catalogo->delete();
        return redirect()->route('catalogo.admin');
    }
}
