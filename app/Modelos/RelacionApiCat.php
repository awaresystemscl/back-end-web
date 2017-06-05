<?php

namespace App\Modelos;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class RelacionApiCat extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "relacion_api_cat";
    protected $fillable = [
        'api_id',
        'categoria_id',
        'ponderacion'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        
    ];

    public function categoria()
    {
        return $this->belongsTo('App\Modelos\Categoria');
    }

    public function api()
    {
        return $this->belongsTo('App\Modelos\Api');
    }
}
//Lineas 13