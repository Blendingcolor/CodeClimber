<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreguntaClasificatoria extends Model
{
    protected $table = 'pregunta_clasificatoria';

    protected $primaryKey='id';

    public $timestamps = false;


    protected $fillable = [
        'Texto',
        'Grupo'];

    public function respuestas()
    {
        return $this->hasMany(RespuestaClasificatoria::class,'pregunta_clasificatoria_id');
    }

    public function rules()
    {
        return [
            'respuestas' => function ($attribute, $value, $fail) {
                if ($this->respuestas->count() > 4) {
                    $fail("La pregunta solo puede tener como máximo cuatro respuestas.");
                }
            },
        ];
    }
}
