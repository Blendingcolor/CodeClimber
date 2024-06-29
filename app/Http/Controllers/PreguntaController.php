<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreguntaClasificatoria;
use App\Http\Requests\GuardarRespuestaRespondidaRequest;
use App\Models\RespuestaRespondidaClasificatoria;
use App\Models\RespuestaClasificatoria;

class PreguntaController extends Controller
{
    public function salidamostrar($moduloClasificado)
    {
        return view('test.terminado', ['moduloClasificado' => $moduloClasificado]);
    }
}