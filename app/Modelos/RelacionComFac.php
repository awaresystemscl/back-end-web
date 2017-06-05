<?php

namespace App\Modelos;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class RelacionComFac extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "relacion_com_fac";
    protected $fillable = [
        'factor_id',
        'componente_id',
        'nivel',
        'posicion',
        'union',
        'tendencia'

    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        
    ];

    public function factor()
    {
        return $this->belongsTo('App\Modelos\Factor');
    }

    public function componente()
    {
        return $this->belongsTo('App\Modelos\Componente');
    }
}
//Lineas 16