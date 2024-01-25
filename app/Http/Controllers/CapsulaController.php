<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Capsula;
use App\Models\Usuario;

use App\Models\Tema;

class CapsulaController extends Controller
{

    public function index()
    {
        $capsulas = Capsula::where('estado', '1')
            ->orderByDesc('fecha')
            ->paginate(12);
        return view('capsula.index', compact('capsulas'));
    }

    public function admin(){
        $capsulas = Capsula::orderByDesc('created_at')
            ->paginate(10);
        return view('capsula.admin', compact('capsulas'));
    }

    public function create()
    {
        $temas = Tema::all();
        return view('capsula.create', compact('temas'));
    }

    public function show($id)
    {
        $capsula = Capsula::find($id);
        if (!$capsula) {
            return abort(404);
        }
        return view('capsula.show', compact('capsula'));
    }

    public function edit($id)
    {
        $capsula = Capsula::find($id);
        $temas = Tema::all();
        return view('capsula.edit', compact('capsula', 'temas'));
    }

    public function destroy($id)
    {
        $capsula = Capsula::find($id);
        $capsula->delete();
        return redirect()->route('capsula.admin');
    }

    public function store(Request $request)
    {
        $url = '';
        $capsula = new Capsula();
        $capsula->titulo = $request->titulo;
        $capsula->descripcion = $request->descripcion;
        
        $capsula->temas = $request->temas;
        
        $iframeCode = $request->url;
        $srcStart = strpos($iframeCode, 'src="');
        if ($srcStart !== false) {
            $srcStart += strlen('src="'); 
            $srcEnd = strpos($iframeCode, '"', $srcStart);
            if ($srcEnd !== false) {
            $url = substr($iframeCode, $srcStart, $srcEnd - $srcStart);
            } 
        }

        $capsula->url = $url;
        
        $capsula->fecha = $request->fecha;
        $capsula->estado = $request->estado;
        $capsula->autorId = $request->user()->id;
        
        if ($request->hasFile("urlImagen")) {
            $file = $request->file("urlImagen");

            $name = time() . "-" . $request->file("urlImagen")->getClientOriginalName();
            $name = str_replace(" ", "-", $name);
            
            $file->storeAs("public/capsulas/" , $name);
    
        $imagePath = storage_path("app/public/capsulas/" .$name);
        $resizedImage = Image::make($imagePath)->fit(320, 320);
        $resizedImage->save(storage_path("app/public/capsulas/" . $name));        
        $capsula->urlImagen = "storage/capsulas/" . $name;

        }
        
        else{
            $capsula->urlImagen = "assets/img/camera-video.svg";
        }

        $capsula->save();
        return redirect()->route('capsula.admin');
    }
    

    public function update(Request $request, $id)
    {
        request()->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
        ]);

        request()->validate([
            'urlImagen' => 'image|mimes:jpeg,png,jpg',
        ]);

        $url = '';
        $capsula = Capsula::find($id);
        $capsula->titulo = $request->titulo;
        $capsula->descripcion = $request->descripcion;

        $iframeCode = $request->url;
        $srcStart = strpos($iframeCode, 'src="');
        if ($srcStart !== false) {
            $srcStart += strlen('src="'); 
            $srcEnd = strpos($iframeCode, '"', $srcStart);
            if ($srcEnd !== false) {
            $url = substr($iframeCode, $srcStart, $srcEnd - $srcStart);
            } 

            $capsula->url = $url;
        }        

        $capsula->fecha = $request->fecha;
        $capsula->estado = $request->estado;
        
        if ($request->hasFile("urlImagen")) {
            $file = $request->file("urlImagen");

            $name = time() . "-" . $request->file("urlImagen")->getClientOriginalName();
            $name = str_replace(" ", "-", $name);
            
            $file->storeAs("public/capsulas/" , $name);
    
            $imagePath = storage_path("app/public/capsulas/" .$name);
            $resizedImage = Image::make($imagePath)->fit(320, 320);
            $resizedImage->save(storage_path("app/public/capsulas/" . $name));        
            
            $capsula->urlImagen = "storage/capsulas/" . $name;
        }

        $capsula->temas = $request->temas;

        $capsula->save();
        return redirect()->route('capsula.admin');
    }


    function getYoutubeThumbnail($url) {
        // Extraer el ID del video de la URL
        parse_str(parse_url($url, PHP_URL_QUERY), $query);
        $videoId = $query['v'];
    
        // Construir la URL de la miniatura
        $thumbnailUrl = "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";
    
        return $thumbnailUrl;
    }

}
