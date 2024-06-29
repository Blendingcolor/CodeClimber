<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Course;
use App\Models\Content;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Alternative;
use App\Models\Answer;
use App\Models\Section;

class ModuloCRUDController extends Controller
{
    public function store(Request $request, $curso_id)
    {
        $request->validate([
            'descripcion' => 'required',
        ]);

        $modulo = new Module();
        $modulo->descripcion = $request->input('descripcion');
        $modulo->video = $request->input('video');
        $modulo->audio = $request->input('audio');
        $modulo->course_id = $curso_id;
        $modulo->save();

        $examen = new Exam();
        $examen->descripcion = 'Examen ejemplo'.$modulo->id;
        $examen->module_id = $modulo->id;
        $examen->save();

        $question = new Question();
        $question->question = 'Pregunta Ejemplo';
        $question->exam_id = $examen->id;
        $question->save();

        $respuesta = new Answer();
        $respuesta->answer = 'Alternativa predeterminada 1';
        $respuesta->save();

        $content = new Content();
        $content->text = 'Prueba de texto';
        $content->image = 'Prueba de imagen';
        $content->code = 'Prueba de code';
        $content->save();

        $section = new Section();
        $section->name = 'Tafur le gusta entero';
        $section->module_id = $modulo->id;
        $section->content_id = $content->id;
        $section->type = 'Patito';
        $section->save();
            
        for ($i = 1; $i <= 4; $i++) {
            $alternativa = new Alternative();
            $alternativa->alternative = 'Alternativa predeterminada ' . $i;
            $alternativa->question_id = $question->id;
            $alternativa->answer_id = $respuesta->id;
            $alternativa->save();
        }
        return redirect()->route('crudscursos.mostrar', $curso_id);
    }

    public function update(Request $request, $curso_id, $id)
    {
        $modulo = Module::where('course_id', $curso_id)->findOrFail($id);
        $modulo->descripcion=$request->input('descripcion');
        $modulo->video=$request->input('video');
        $modulo->audio=$request->input('audio');
        $modulo->save();

        return redirect()->route('crudscursos.mostrar', $curso_id);
    }

    public function destroy($curso_id, $id)
    {
        $modulo = Module::where('course_id', $curso_id)->findOrFail($id);
        $modulo->delete();

        return redirect()->route('crudscursos.mostrar', $curso_id);
    }

    public function editar($curso_id, $id)
    {
        $curso = Course::findOrFail($curso_id);
        $modulo = Module::where('course_id', $curso_id)->findOrFail($id);
        return view('cruds.editarmodulo', compact('curso', 'modulo'));
    }

    public function mostrar($curso_id, $id)
    {
        $curso = Course::findOrFail($curso_id);

        $modulo = Module::findOrFail($id);

        $contenidoExistente = Content::where('module_id', $modulo->id)->exists();

        if (!$contenidoExistente) {
            $nuevoContenido = Content::create([
                'text' => 'Ingrese sus datos',
                'image' => 'Ingrese la URL de la imagen',
                'video' => 'Ingrese la URL del video',
                'module_id' => $modulo->id,
            ]);
        }

        $contenidos = Content::where('module_id', $modulo->id)->get();

        return view('cruds.mostrarcontenido', compact('contenidos', 'modulo', 'curso'));
    }

    public function editarcontenido($id, Request $request)
    {
        $contenido = Content::findOrFail($id);

        $contenido->update([
            'text' => $request->input('text'),
            'image' => $request->input('image'),
            'video' => $request->input('video'),
        ]);

        return redirect()->route('crudscursos.mostrar', [$contenido->module->course_id]);
    }


    public function listadopreguntasexamen(Request $request, $curso_id, $id)
    {
        $curso = Course::findOrFail($curso_id);
        $modulo = Module::findOrFail($id);
        $examenExistente = Exam::where('module_id', $modulo->id)->exists();

        if (!$examenExistente) {
            $nuevoExamen = Exam::create([
                'descripcion' => $modulo->descripcion,
                'module_id' => $modulo->id,
            ]);
        }
        $examen = Exam::where('module_id', $modulo->id)->first();
        $preguntas = $examen->questions;

        return view('cruds.listadopreguntaexamen', compact('preguntas', 'modulo', 'curso', 'examen'));
    }


    public function CrearPregunta(Request $request, $curso_id, $id, $exam_id)
    {
        $request->validate([
            'question' => 'required',
        ]);

        $curso = Course::findOrFail($curso_id);
        $modulo = Module::findOrFail($id);
        $examen = Exam::findOrFail($exam_id);

        $question = new Question();
        $question->question = $request->question;
        $question->exam_id = $examen->id;
        $question->save();

        $respuesta = new Answer();
        $respuesta->answer = 'Respuesta Predeterminada';
        $respuesta->save();

        for ($i = 1; $i <= 4; $i++) {
            $alternativa = new Alternative();
            $alternativa->alternative = 'Alternativa predeterminada ' . $i;
            $alternativa->question_id = $question->id;
            $alternativa->answer_id = $respuesta->id;
            $alternativa->save();
        }
        return redirect()->route('crudscursos.examen.mostrar', ['curso_id' => $curso_id, 'id' => $id, 'exam_id' => $exam_id]);
    }

    public function EliminarPregunta($curso_id, $id, $exam_id, $question_id)
    {
        $curso = Course::findOrFail($curso_id);
        $modulo = Module::findOrFail($id);
        $examen = Exam::findOrFail($exam_id);
        $pregunta = Question::findOrFail($question_id);

        $pregunta->delete();

        return redirect()->route('crudscursos.examen.mostrar', [
            'curso_id' => $curso_id,
            'id' => $id,
            'exam_id' => $exam_id
        ])->with('success', 'Pregunta eliminada correctamente');
    }

    public function EditarPregunta($curso_id, $id, $exam_id, $question_id)
    {
        $curso = Course::findOrFail($curso_id);
        $modulo = Module::findOrFail($id);
        $examen = Exam::findOrFail($exam_id);
        $pregunta = Question::findOrFail($question_id);

        return view('cruds.editarpreguntas', compact('curso', 'modulo', 'examen', 'pregunta'));
    }

    public function ActualizarPregunta(Request $request, $curso_id, $id, $exam_id, $question_id)
    {
        $curso = Course::findOrFail($curso_id);
        $modulo = Module::findOrFail($id);
        $examen = Exam::findOrFail($exam_id);

        $pregunta = Question::where('exam_id', $exam_id)->findOrFail($question_id);

        $pregunta->question = $request->question;
        $pregunta->save();

        return redirect()->route('crudscursos.examen.mostrar', ['curso_id' => $curso_id, 'id' => $id, 'exam_id' => $exam_id]);
    }

    public function MostrarAlternativas(Request $request, $curso_id, $id, $exam_id, $question_id)
    {
        $curso = Course::findOrFail($curso_id);
        $modulo = Module::findOrFail($id);
        $examen = Exam::findOrFail($exam_id);
        $pregunta = Question::findOrFail($question_id);

        $alternativas = Alternative::where('question_id', $pregunta->id)->get();
        
        $respuesta = null;

        foreach ($alternativas as $alternativa) {
            if ($alternativa->answer) {
                $respuesta = $alternativa->answer->id;
                break;
            }
        }
        return view('cruds.listaalternativas', compact('alternativas', 'modulo', 'curso', 'examen', 'pregunta', 'respuesta'));
    }

    public function CrearAlternativa(Request $request, $curso_id, $id, $exam_id, $question_id)
    {
        $request->validate([
            'alternative' => 'required',
        ]);

        $curso = Course::findOrFail($curso_id);
        $modulo = Module::findOrFail($id);
        $examen = Exam::findOrFail($exam_id);
        $pregunta = Question::findOrFail($question_id);

        $respuestaExistente = Answer::whereHas('alternatives', function ($query) use ($question_id) {
            $query->where('question_id', $question_id);
        })->first();

        if (!$respuestaExistente) {
            $answer = Answer::create([
                'answer' => 'Respuesta predeterminada',
            ]);
        } else {
            $answer = $respuestaExistente;
        }

        $alternative = new Alternative();
        $alternative->alternative = $request->alternative;
        $alternative->question_id = $pregunta->id;
        $alternative->answer_id = $answer->id;

        $alternative->save();
        return redirect()->route('crudscursos.alternativas.mostrar', ['curso_id' => $curso_id,'id' => $id,'exam_id' => $exam_id,'question_id' => $question_id]);
    }
    
    public function EliminarAlternativa($curso_id, $id, $exam_id, $question_id, $alternative_id)
    {
        $curso = Course::findOrFail($curso_id);
        $modulo = Module::findOrFail($id);
        $examen = Exam::findOrFail($exam_id);
        $pregunta = Question::findOrFail($question_id);
        $alternativa = Alternative::findOrFail($alternative_id);

        $alternativa->delete();

        return redirect()->route('crudscursos.alternativas.mostrar', [
            'curso_id' => $curso_id,
            'id' => $id,
            'exam_id' => $exam_id,
            'question_id' => $question_id
        ])->with('success', 'Alternativa eliminada correctamente');
    }

    public function EditarAlternativa($curso_id, $id, $exam_id, $question_id, $alternative_id)
    {
        $curso = Course::findOrFail($curso_id);
        $modulo = Module::findOrFail($id);
        $examen = Exam::findOrFail($exam_id);
        $pregunta = Question::findOrFail($question_id);
        $alternativa = Alternative::findOrFail($alternative_id);

        return view('cruds.editaralternativa', compact('curso', 'modulo', 'examen', 'pregunta', 'alternativa'));
    }

    public function ActualizarAlternativa(Request $request, $curso_id, $id, $exam_id, $question_id, $alternative_id)
    {
        $curso = Course::findOrFail($curso_id);
        $modulo = Module::findOrFail($id);
        $examen = Exam::findOrFail($exam_id);
        $pregunta = Question::findOrFail($question_id);

        $alternativa = Alternative::where('question_id', $question_id)->findOrFail($alternative_id);

        $alternativa->alternative = $request->alternative;
        $alternativa->save();

        return redirect()->route('crudscursos.alternativas.mostrar', ['curso_id' => $curso_id, 'id' => $id, 'exam_id' => $exam_id, 'question_id' => $question_id]);
    }

    public function EditarRespuesta($curso_id, $id, $exam_id, $question_id, $alternative_id, $respuesta_id)
    {
        $curso = Course::findOrFail($curso_id);
        $modulo = Module::findOrFail($id);
        $examen = Exam::findOrFail($exam_id);
        $pregunta = Question::findOrFail($question_id);
        $alternativa = Alternative::findOrFail($alternative_id);
        $respuesta = Answer::findOrFail($respuesta_id);

        return view('cruds.editarrespuesta', compact('curso_id', 'id', 'exam_id', 'question_id','alternative_id', 'respuesta_id', 'alternativa','modulo', 'curso', 'examen', 'pregunta', 'respuesta'));
    }

    public function actualizarRespuesta(Request $request, $curso_id, $id, $exam_id, $question_id, $alternative_id, $respuesta_id)
    {
        $request->validate([
            'answer' => 'required|string',
        ]);

        $respuesta = Answer::findOrFail($respuesta_id);
        $respuesta->answer = $request->answer;
        $respuesta->save();

        return redirect()->route('crudscursos.alternativas.mostrar', ['curso_id' => $curso_id, 'id' => $id, 'exam_id' => $exam_id, 'question_id' => $question_id])->with('success', 'Respuesta actualizada correctamente');
    }
}


    

