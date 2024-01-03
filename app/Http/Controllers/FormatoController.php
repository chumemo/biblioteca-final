<?php

namespace App\Http\Controllers;

use App\Models\Formato;
use Illuminate\Http\Request;
use App\Models\Tema;
use App\Models\Autoridad;

class FormatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formatos = Formato::where('estado', '1')
            ->orderBy('fecha')
            ->paginate(6);
        return view("formato.index", compact("formatos"));
    }

    public function admin()
    {
        $formatos = Formato::orderByDesc('created_at')
            ->paginate(10);
        return view("formato.admin", compact("formatos"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $temas = Tema::all();
        $autoridades = Autoridad::all();
        return view("formato.create",compact("temas","autoridades"));
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
        $formato->autoridadId = $request->autoridad;
        $formato->temaId = $request->tema;
        
        if ($request->hasFile("urlArchivo")) {
            $file = $request->file("urlArchivo");

            $name = time() . "-" . $request->file("urlArchivo")->getClientOriginalName();
            $name = str_replace(" ", "-", $name);
            
            $file->storeAs("public/formatos/" , $name);
    
        $documentPath = storage_path("app/public/formatos/" .$name);
                
        $formato->urlDocumento = "storage/formatos/" . $name;
        
        $formato->nombreArchivo = $name;
        
        $extension = $file->getClientOriginalExtension();
        $urlImagenThumb = asset("assets/img/ICONO-Formatos.png");
        $formato->urlImagenThumb = $urlImagenThumb;
        
    } else {
        $formato->urlImagenThumb = asset('assets/img/ICONO-Formatos.png');
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
        $temas = Tema::all();
        $autoridades = Autoridad::all();
        return view("formato.edit", compact("formato", 'temas', 'autoridades'));
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
        $formato->autoridadId = $request->autoridad;
        $formato->temaId = $request->tema;
        
        
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
            
    } else {
        $formato->urlImagenThumb = asset('assets/img/ICONO-Formatos.png');
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

    public function show(string $id)
    {
        $formato = Formato::find($id);
        if (!$formato) {
            return abort(404);
        }
        return view('formato.show', compact('formato'));
    }
}
