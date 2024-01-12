<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Autoridad;
use App\Models\Tema;
use App\Models\User;

class Documento extends Model
{
    use HasFactory;

    protected $fillable = [
        "titulo","tema","acuerdo","sentencia","sintesis","urlimg","urldoc","temas"
    ];
    
    protected $title = "documentos";
    
    public function autor()
    {
        return $this->belongsTo(User::class, 'autorId');
    }

    public function autoridad()
    {
        return $this->belongsTo(Autoridad::class, 'autoridadId');
    }

    public function tema()
    {
        return $this->belongsTo(Tema::class, 'temaId');
    }

    
}
