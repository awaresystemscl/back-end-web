<?php

namespace App\Modelos;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "componentes";
    protected $fillable = [
        'descripcion',
        'categoria',
        'mashup_id',
        'api_id',
        'url'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        
    ];

    public function mashup()
    {
    	return $this->belongsTo('App\Modelos\Mashup');
    }

    public function api()
    {
    	return $this->belongsTo('App\Modelos\Item');
    }

    public function RelacionComFac()
    {
    	return $this->hasMany('App\Modelos\RelacionComFac');
    }

}
//Lineas 18