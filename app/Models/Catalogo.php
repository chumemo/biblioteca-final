<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Archivo;

class Catalogo extends Model
{
    use HasFactory;
    protected $fillable = [
        "titulo","urlImagen","urlDocumento", "nombreArchivo", "temas"
    ];

        protected $title = "catalogos";

    
}

