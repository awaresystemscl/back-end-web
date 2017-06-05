<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mashup extends Model
{

    // protected $table = "mashups";
    // protected $fillable = [
    //     'nombre',
    //     'descripcion',
    //     'url',
    //     'usuario_id'
    // ];

    protected $table = "mashups";
    protected $fillable = [
        'nombre',
        'descripcion'
    ];


}
