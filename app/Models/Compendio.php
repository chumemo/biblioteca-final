<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Criterio;
use App\Models\Tema;

class Compendio extends Model
{
    use HasFactory;
    protected $fillable = [
        "criterio", "anio", "autorId", "area", "titulo", "descripcion", "urlDocumento", "urlImagen", "estado" , "tema"
    ];

    protected $title = "compendios";

    public function autor()
    {
        return $this->belongsTo(User::class, 'autorId');
    }

    public function criterioId()
    {
        return $this->belongsTo(Criterio::class, 'criterio');
    }

    public function temaId()
    {
        return $this->belongsTo(Tema::class, 'tema');
    }
}
