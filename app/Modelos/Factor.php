<?php

namespace App\Modelos;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Factor extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "factores";
    protected $fillable = [
        'nombre'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        
    ];


    public function RelacionComFac()
    {
    	return $this->hasMany('App\Modelos\RelacionComFac');
    }

    public function RelacionApiFac()
    {
    	return $this->hasMany('App\Modelos\RelacionApiFac');
    }

}
//Lineas 11