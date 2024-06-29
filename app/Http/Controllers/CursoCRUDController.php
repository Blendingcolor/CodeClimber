<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCursos;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Module;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Alternative;
use App\Models\Answer;
use App\Models\Content;
use App\Models\Section;


class CursoCRUDController extends Controller
{
    public function listado(){
        $cursos = Course::get();
        return view('cruds.cursoscrud', compact('cursos'));
    }

    public function create(Request $request)
    {
        $curso = new Course();
        $curso->name = $request->input('name');
        $curso->description = $request->input('description');
        $curso->precio= $request->input('precio');
        $curso->image= $request->input('image');
        $curso->period= $request->input('period');
        $curso->color= $request->input('color');
        $curso->save();

        $modulo = new Module();
        $modulo->descripcion = 'Modulo 1 Ejemplo';
        $modulo->video = 'patito.com';
        $modulo->audio = 'pedrito.com';
        $modulo->course_id = $curso->id;
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

        return redirect()->route('crudscursos.listado');
    }

    public function editar($id)
    {
        $curso = Course::with('modules')->findOrFail($id);
        return view('cruds.editcursos', compact('curso'));
    }

    public function update(Request $request, $id)
    {
        $curso = Course::findOrFail($id);
        $curso->name = $request->input('name');
        $curso->description = $request->input('description');
        $curso->precio= $request->input('precio');
        $curso->image= $request->input('image');
        $curso->period= $request->input('period');
        $curso->color= $request->input('color');
        $curso->save();

        return redirect()->route('crudscursos.listado');
    }

    public function destroy($id)
    {
        $curso = Course::findOrFail($id);
        $curso->delete();

        return redirect()->route('crudscursos.listado');
    }

    public function mostrar($id)
    {
    $curso = Course::with('modules')->findOrFail($id);
    return view('cruds.mostrarcursos', compact('curso'));
    }
}
