<?php

namespace App\Http\Controllers;
use App\Models\Catalogo;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catalogos = Catalogo::paginate(10);
        return view("catalogo.index", compact("catalogos"));    
    }

    public function admin()
    {
        // $catalogos = Catalogo::paginate(10);
        // return view("catalogo.index", compact("catalogos"));    
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
