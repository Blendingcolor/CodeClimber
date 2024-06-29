<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alertas;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    public function mostrar()
    {
        return view('comentarios.index');
    }
    public function guardar(Request $request)
    {
        $userId = Auth::id();
        $problema = new Alertas();
        $problema->ruta = $request->ruta;
        $problema->problema = $request->problema;
        $problema->descripcion_del_problema = $request->descripcion;
        $problema->fecha_del_problema = now();
        $problema->usuario_id = $userId;
        $problema->save();
        return redirect()->route('home.index');
    }
}
