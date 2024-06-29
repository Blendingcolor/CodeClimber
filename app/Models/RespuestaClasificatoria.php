<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestaClasificatoria extends Model
{
    protected $table = 'respuesta_clasificatoria';


    protected $primaryKey='id';

    public $timestamps = false;

    protected $fillable=[
        'Texto',
        'Valor',
        'pregunta_clasificatoria_id'
    ];

    public function pregunta()
    {
        return $this->belongsTo(PreguntaClasificatoria::class, 'pregunta_clasificatoria_id');
    }

    public function respuestasRespondidas()
    {
        return $this->hasMany(RespuestaRespondidaClasificatoria::class,'respuesta_clasificatoria_id');
    }
}
