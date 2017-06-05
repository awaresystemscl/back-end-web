<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Mashup extends Model
{
	use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "mashups";
    protected $fillable = [
        'nombre',
        'descripcion',
        'url',
        'usuario_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        
    ];

    public function sucursales()
    {
        return $this->belongsTo('App\Usuario');
    }

    public function componente()
    {
    	return $this->hasMany('App\Modelos\Componente');
    }

}
//Lineas 14