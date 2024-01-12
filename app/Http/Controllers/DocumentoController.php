<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Autoridad;
use App\Models\Tema;

class DocumentoController extends Controller
{
    public function index(Request $request)
    {

        $request = request(); 
        // $request->path();
        
        $autoridadid_param = $request->fullUrl();
        //$autoridadid_param = $request->query('autoridadid');
        // obtener de la url la variable autodidadid


        // $urlCompleta = request()->fullUrl();
        // $partesUrl = parse_url($urlCompleta);
        // $autoridadid_param = $partesUrl[1];
        

        $autoridades = Autoridad::all();
        $documentos = Documento::where('estado', '1')
        ->orderByDesc('fecha')
        ->paginate(12);

        if($request->has('autoridadId'))
        {
            // $documentos = Documento::where('autoridadId', $request->autoridadId)->orderByDesc('fecha')->paginate(20);
            $documentos = Documento::where('autoridadId', $request->autoridadId)->orderByDesc('fecha')->paginate(50);
        } 
        return view('documento.index', compact('documentos', 'autoridades', 'autoridadid_param'));
    }

    public function admin()
    {
        $documentos = Documento::orderByDesc('created_at')->paginate(10);
        return view('documento.admin', compact('documentos'));
    }

    public function create()
    {
        $autoridades = Autoridad::all();
        $temas = Tema::all();
        return view('documento.create', compact('autoridades', 'temas'));
    }

    public function show($id)
    {
        $documento = Documento::find($id);
        
        if (!$documento || $documento->estado == 0) {
            abort(404);
        }

        return view('documento.show', compact('documento'));
    }

    public function edit($id)
    {
        $documento = Documento::findOrFail($id);
        $autoridades = Autoridad::all();
        $temas = Tema::all();
        return view('documento.edit', compact('documento', 'autoridades', 'temas'));
    }

    public function destroy($id)
    {
        $documento = Documento::findOrFail($id);
        $documento->delete();
        return redirect()->route('documento.admin');
    }

    public function store(Request $request)
    {
        $documento = new Documento();
        $documento->titulo = $request->titulo;
        $documento->descripcion = $request->descripcion;
        $documento->fecha = $request->fecha;
        $documento->estado = $request->estado;
        $documento->autorId = $request->user()->id;
        $documento->autoridadId = $request->autoridad;
        $documento->temaId = $request->tema;
        

        $documento->temas = $request->temas;

        if ($request->hasFile("urlImagen")) {
            $file = $request->file("urlImagen");

            $name = time() . "-" . $request->file("urlImagen")->getClientOriginalName();
            $name = str_replace(" ", "-", $name);
            
            $file->storeAs("public/documentos/" , $name);
    
        $imagePath = storage_path("app/public/documentos/" .$name);
        $resizedImage = Image::make($imagePath)->fit(320, 320);
        $resizedImage->save(storage_path("app/public/documentos/" . $name));        
        $documento->urlImagen = "storage/documentos/" . $name;

        }
        
        else{
            $documento->urlImagen = "assets/img/ICONO-Documentos.png";
        }

        if ($request->hasFile("urlDocumento")) {
            $file = $request->file("urlDocumento");

            $name = time() . "-" . $request->file("urlDocumento")->getClientOriginalName();
            $name = str_replace(" ", "-", $name);
            
            $file->storeAs("public/documentos/" , $name);
    
        $documento->urlDocumento = "storage/documentos/" . $name;
        $documento->nombreArchivo = $name;
        
        }

        $documento->save();

        return redirect()->route('documento.admin');
    }

    public function update(Request $request, $id)
    {
        $documento = Documento::findOrFail($id);
        $documento->titulo = $request->titulo;
        $documento->descripcion = $request->descripcion;
        $documento->fecha = $request->fecha;
        $documento->estado = $request->estado;
        $documento->autorId = $request->user()->id;
        $documento->autoridadId = $request->autoridad;
        $documento->temaId = $request->tema;

        $documento->temas = $request->temas;
        
        if ($request->hasFile("urlImagen") && $request->file("urlImagen") != null && $request->file("urlImagen") != "") {
            $file = $request->file("urlImagen");

            $name = time() . "-" . $request->file("urlImagen")->getClientOriginalName();
            $name = str_replace(" ", "-", $name);
            
            $file->storeAs("public/documentos/" , $name);
    
        $imagePath = storage_path("app/public/documentos/" .$name);
        $resizedImage = Image::make($imagePath)->fit(320, 320);
        $resizedImage->save(storage_path("app/public/documentos/" . $name));        
        $documento->urlImagen = "storage/documentos/" . $name;

        }
        
        else{
            if($documento->urlImagen == null || $documento->urlImagen == ""){
                $documento->urlImagen = "assets/img/ICONO-Documentos.png";
            }
        }

        if ($request->hasFile("urlDocumento") && $request->file("urlDocumento") != null && $request->file("urlDocumento") != "") {
            $file = $request->file("urlDocumento");

            $name = time() . "-" . $request->file("urlDocumento")->getClientOriginalName();
            $name = str_replace(" ", "-", $name);
            
            $file->storeAs("public/documentos/" , $name);
    
        $documento->urlDocumento = "storage/documentos/" . $name;

        }

        $documento->save();
        return redirect()->route('documento.admin');
    }
}
