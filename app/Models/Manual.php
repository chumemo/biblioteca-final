<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manual extends Model
{
    use HasFactory;

    protected $fillable = [

        "titulo","urlThumb","urlPDF", "temas"];

        protected $title = "manuals";
}
