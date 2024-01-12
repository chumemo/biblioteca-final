<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folleto extends Model
{
    use HasFactory;
    protected $fillable = [

        "titulo","url","temas"];

        protected $title = "folletos";

}
