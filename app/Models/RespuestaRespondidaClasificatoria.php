<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestaRespondidaClasificatoria extends Model
{
    protected $table = 'respuesta_respondida_clasificatoria';

    public $timestamps = false;

    protected $fillable = [
        'clasificatorio_usuario_id',
        'pregunta_clasificatoria_id',
        'respuesta_clasificatoria_id',
        'usuario_id',
        'Correcta',
        'Puntajeobtenido',
    ];

    public function clasificatorioUsuario()
    {
        return $this->belongsTo(ClasificatorioUsuario::class, 'clasificatorio_usuario_id');
    }

    public function pregunta()
    {
        return $this->belongsTo(PreguntaClasificatoria::class, 'pregunta_clasificatoria_id');
    }

    public function respuesta()
    {
        return $this->belongsTo(RespuestaClasificatoria::class, 'respuesta_clasificatoria_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

}
