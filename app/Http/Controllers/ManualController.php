<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Manual;

class ManualController extends Controller
{

    public function index()
    {
        $manuales = Manual::where('estado', '1')
            ->orderBy('fecha')
            ->paginate(6);
        return view("manual.index", compact("manuales"));
    }

    public function admin() 
    {
        $manuales = Manual::orderByDesc('created_at')
            ->paginate(10);
        return view("manual.admin", compact("manuales"));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("manual.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $manual = new Manual();
        $manual->titulo = $request->titulo;
        $manual->fecha = $request->fecha;
        $manual->estado = $request->estado;
        $manual->autorId = $request->user()->id;
        
        if ($request->hasFile("urlImagen")) {
            $file = $request->file("urlImagen");

            $name = time() . "-" . $request->file("urlImagen")->getClientOriginalName();
            $name = str_replace(" ", "-", $name);
            
            $file->storeAs("public/manuales/" , $name);
    
        $imagePath = storage_path("app/public/manuales/" .$name);
        $resizedImage = Image::make($imagePath)->fit(420, 520);
        $resizedImage->save(storage_path("app/public/manuales/" . $name));        
        $manual->urlImagen = "storage/manuales/" . $name;

        }
        
        else{
            $manual->urlImagen = "assets/img/ICONO-Folletos.png";
        }

        if ($request->hasFile("urlDocumento")) {
            $file = $request->file("urlDocumento");

            $name = time() . "-" . $request->file("urlDocumento")->getClientOriginalName();
            $name = str_replace(" ", "-", $name);
            
            $file->storeAs("public/manuales/" , $name);
    
        $manual->urlDocumento = "storage/manuales/" . $name;
        $manual->nombreArchivo = $name;
        
        }

        $manual->save();

        return redirect()->route('manual.admin');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $manual = Manual::find($id);

        if (!$manual) {
            abort(404); 
        }
    
        return view('manual.show', compact('manual'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $manual = Manual::find($id);
        return view("manual.edit", compact("manual"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $manual = Manual::find($id);
        $manual->titulo = $request->titulo;
        $manual->fecha = $request->fecha;
        $manual->estado = $request->estado;
        
        if ($request->hasFile("urlImagen")) {
            $file = $request->file("urlImagen");

            $name = time() . "-" . $request->file("urlImagen")->getClientOriginalName();
            $name = str_replace(" ", "-", $name);
            
            $file->storeAs("public/manuales/" , $name);
    
        $imagePath = storage_path("app/public/manuales/" .$name);
        $resizedImage = Image::make($imagePath)->fit(320, 320);
        $resizedImage->save(storage_path("app/public/manuales/" . $name));        
        $manual->urlImagen = "storage/manuales/" . $name;

        }
        
        else{
            $manual->urlImagen = "assets/img/ICONO-Folletos.png";
        }

        if ($request->hasFile("urlDocumento")) {
            $file = $request->file("urlDocumento");

            $name = time() . "-" . $request->file("urlDocumento")->getClientOriginalName();
            $name = str_replace(" ", "-", $name);
            
            $file->storeAs("public/manuales/" , $name);
    
        $manual->urlDocumento = "storage/manuales/" . $name;

        }

        $manual->save();
        return redirect()->route('manual.admin');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $manual = Manual::find($id);
        $manual->delete();
        return redirect()->route('manual.admin');
    }
}
