<?php

namespace App\Http\Controllers;


use App\Models\Folleto;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class FolletoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $folletos= Folleto::where('estado', '1')
            ->orderByDesc('fecha')
            ->paginate(6);
        return view("folleto.index",compact("folletos"));
    }

    public function admin()
    {
        $folletos= Folleto::orderByDesc('created_at')
            ->paginate(10);
        return view("folleto.admin",compact("folletos"));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("folleto.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $folleto = new Folleto();
        $folleto->titulo = $request->titulo;
        $folleto->fecha = $request->fecha;
        $folleto->estado = $request->estado;
        $folleto->autorId = $request->user()->id;
        
        if ($request->hasFile("urlImagen")) {
            $file = $request->file("urlImagen");

            $name = time() . "-" . $request->file("urlImagen")->getClientOriginalName();
            $name = str_replace(" ", "-", $name);
            
            $file->storeAs("public/folletos/" , $name);
    
        $imagePath = storage_path("app/public/folletos/" .$name);
        $resizedImage = Image::make($imagePath)->fit(320, 320);
        $resizedImage->save(storage_path("app/public/folletos/" . "thumb-" . $name ));        
        $folleto->urlImagen = "storage/folletos/" . $name;
        $folleto->urlImagenThumb = "storage/folletos/" . "thumb-" . $name;

        }
        
        else{
            $folleto->urlImagenThumb = "assets/img/ICONO-Folletos.png";
        }

        $folleto->save();
        return redirect()->route('folleto.admin');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $folleto = Folleto::find($id);

        if (!$folleto) {
            abort(404);
        }
    
        return view('folleto.show', compact('folleto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $folleto = Folleto::find($id);
        return view('folleto.edit', compact('folleto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $folleto = Folleto::find($id);
        $folleto->titulo = $request->titulo;
        $folleto->fecha = $request->fecha;
        $folleto->estado = $request->estado;
        
        if ($request->hasFile("urlImagen")) {
            $file = $request->file("urlImagen");

            $name = time() . "-" . $request->file("urlImagen")->getClientOriginalName();
            $name = str_replace(" ", "-", $name);
            
            $file->storeAs("public/folletos/" , $name);
    
        $imagePath = storage_path("app/public/folletos/" .$name);
        $resizedImage = Image::make($imagePath)->fit(320, 320);
        $resizedImage->save(storage_path("app/public/folletos/" . "thumb-" . $name ));        
        $folleto->urlImagen = "storage/folletos/" . $name;
        $folleto->urlImagenThumb = "storage/folletos/" . "thumb-" . $name;

        }
        
        else{
            $folleto->urlImagen = "assets/img/ICONO-Folletos.png";
        }

        $folleto->save();
        return redirect()->route('folleto.admin');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    { 
        $folleto = Folleto::find($id);
        $folleto->delete();
        return redirect()->route('folleto.admin');
    
    }
}
