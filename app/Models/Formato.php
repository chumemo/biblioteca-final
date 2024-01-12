<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Autoridad;
use App\Models\Tema;
use App\Models\User;


class Formato extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "titulo","urlImagen","urlDocumento","temas"
    ];

        protected $title = "formatos";
    
        public function autoridad()
        {
            return $this->belongsTo(Autoridad::class, 'autoridadId');
        }

        public function tema()
        {
            return $this->belongsTo(Tema::class, 'temaId');
        }

        public function autor()
        {
            return $this->belongsTo(User::class, 'autorId');
        }
}
