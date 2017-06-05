<?php

namespace App\Modelos;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class RelacionApiFac extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "relacion_api_fac";
    protected $fillable = [
        'api_id',
        'factor_id',
        'fecha'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        
    ];

    public function factor()
    {
        return $this->belongsTo('App\Modelos\Factor');
    }

    public function api()
    {
        return $this->belongsTo('App\Modelos\Api');
    }
}
//Lineas 13