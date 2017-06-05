<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Api extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "apis";
    protected $fillable = [
        'nombre',
        'descripcion',
        'url'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        
    ];

    public function componente()
    {
    	return $this->hasMany('App\Modelos\Componente');
    }

    public function RelacionApiCat()
    {
    	return $this->hasMany('App\Modelos\RelacionApiCat');
    }

    public function RelacionApiFac()
    {
    	return $this->hasMany('App\Modelos\RelacionApiFac');
    }
}
//Lineas 14