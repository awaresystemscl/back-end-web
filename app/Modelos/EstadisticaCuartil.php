<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class EstadisticaCuartil extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "estadistica_cuartil";
    protected $fillable = [
        'nivel_factor',
        'minimo',
        'medio',
        'maximo',
        'categoria',
        'factor_id',
        'fecha'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}