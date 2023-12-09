<?php

namespace App\Http\Controllers;

use App\Models\Formato;
use Illuminate\Http\Request;

class FormatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formatos = Formato::paginate(20);
        return view("formato.index", compact("formatos"));
    }

    public function admin()
    {
        $formatos = Formato::paginate(20);
        return view("formato.admin", compact("formatos"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("formato.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $formato = new Formato();
        $formato->titulo = $request->titulo;
        $formato->fecha = $request->fecha;
        $formato->estado = $request->estado;
        $formato->autorId = $request->user()->id;
        
        if ($request->hasFile("urlArchivo")) {
            $file = $request->file("urlArchivo");

            $name = time() . "-" . $request->file("urlArchivo")->getClientOriginalName();
            $name = str_replace(" ", "-", $name);
            
            $file->storeAs("public/formatos/" , $name);
    
        $documentPath = storage_path("app/public/formatos/" .$name);
                
        $formato->urlDocumento = "storage/formatos/" . $name;

        $extension = $file->getClientOriginalExtension();
        $urlImagenThumb = asset("assets/img/ICONO-Formatos.png");
        $formato->urlImagenThumb = $urlImagenThumb;
            
        }
        
        $formato->save();
        return redirect()->route('formato.admin');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $formato = Formato::find($id);
        return view("formato.edit", compact("formato"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $formato = Formato::find($id);
        $formato->titulo = $request->titulo;
        $formato->fecha = $request->fecha;
        $formato->estado = $request->estado;
        
        
        if ($request->hasFile("urlArchivo")) {
            $file = $request->file("urlArchivo");

            $name = time() . "-" . $request->file("urlArchivo")->getClientOriginalName();
            $name = str_replace(" ", "-", $name);
            
            $file->storeAs("public/formatos/" , $name);
    
        $documentPath = storage_path("app/public/formatos/" .$name);
                
        $formato->urlDocumento = "storage/formatos/" . $name;

        $extension = $file->getClientOriginalExtension();
        $urlImagenThumb = asset("assets/img/ICONO-Formatos.png");
        $formato->urlImagenThumb = $urlImagenThumb;
            
        }
        
        $formato->save();
        return redirect()->route('formato.admin');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $formato = Formato::find($id);
        $formato->delete();
        return redirect()->route('formato.admin');
    }
}