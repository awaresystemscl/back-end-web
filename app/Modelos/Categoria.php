<?php

namespace App\Modelos;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "categorias";
    protected $fillable = [
        'nombre'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        
    ];

    public function RelacionApiCat()
    {
    	return $this->hasMany('App\Modelos\RelacionApiCat');
    }

}
//Lineas 9