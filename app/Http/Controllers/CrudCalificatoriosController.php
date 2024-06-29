<?php

namespace App\Http\Controllers;

use App\Models\PreguntaClasificatoria;
use Illuminate\Http\Request;
use App\Models\RespuestaClasificatoria;
use App\Http\Requests\CreatePreguntaClasificatoria;
use App\Http\Requests\UpdatePreguntaClasificatoria;

class CrudCalificatoriosController extends Controller
{
    public function listado(){
        $preguntas = PreguntaClasificatoria::with('respuestas')->get();
        return view('cruds.preguntascrud', compact('preguntas'));
    }
    public function create(CreatePreguntaClasificatoria $request)
    {
        $pregunta = new PreguntaClasificatoria();
        $pregunta->texto = $request->input('texto');
        $pregunta->grupo = $request->input('grupo');
        $pregunta->save();

         // Crear las respuestas asociadas
        foreach ($request->input('respuestas') as $index => $respuestaData) {
            $respuesta = new RespuestaClasificatoria();
            $respuesta->texto = $respuestaData['texto'];
            $respuesta->valor = ($index == $request->input('correcta')) ? 1 : 0;
            $respuesta->pregunta_clasificatoria_id = $pregunta->id;
            $respuesta->save();
        }
        return redirect()->route('crudsclasificatorio.listado')->with('success', 'Pregunta y respuestas creadas exitosamente');
     }

     public function editar($id)
    {
        $pregunta = PreguntaClasificatoria::with('respuestas')->findOrFail($id);
        return view('cruds.editarclasificatorio', compact('pregunta'));
    }

    public function update(Request $request, $id)
{
    // Buscar la pregunta por ID
    $pregunta = PreguntaClasificatoria::findOrFail($id);

    // Actualizar los datos de la pregunta
    $pregunta->Texto = $request->input('texto');
    $pregunta->Grupo = $request->input('grupo');
    $pregunta->save();

    // Actualizar las respuestas relacionadas
    foreach ($request->input('respuestas') as $respuestaId => $respuestaData) {
        $respuesta = RespuestaClasificatoria::findOrFail($respuestaId);
        $respuesta->Texto = $respuestaData['texto'];
        $respuesta->Valor = $respuestaId == $request->input('correcta') ? 1 : 0;
        $respuesta->save();
    }

    // Redirigir con un mensaje de éxito
    return redirect()->route('crudsclasificatorio.listado')->with('success', 'Pregunta y respuestas actualizadas exitosamente');
}
    public function destroy($id)
    {
        // Buscar la pregunta por ID
        $pregunta = PreguntaClasificatoria::findOrFail($id);

        // Eliminar las respuestas relacionadas
        foreach ($pregunta->respuestas as $respuesta) {
            $respuesta->delete();
        }

        // Eliminar la pregunta
        $pregunta->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('crudsclasificatorio.listado')->with('success', 'Pregunta y respuestas eliminadas exitosamente');
    }

}
