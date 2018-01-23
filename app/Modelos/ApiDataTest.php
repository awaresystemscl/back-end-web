<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ApiDataTest extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "apis_data_test";
    protected $fillable = [
        'nombre',
        'rendimiento',
        'latencia',
        'status',
        'tiempo_de_respuesta',
        'disponibilidad',
        'confiabilidad',
        'fecha'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
//Lineas 14