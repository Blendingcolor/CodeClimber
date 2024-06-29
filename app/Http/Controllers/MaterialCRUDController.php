<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Section;
use App\Models\Course;
use App\Models\Module;
use Random\Engine\Secure;

class MaterialCRUDController extends Controller
{
    public function ShowSections($curso_id, $id)
    {
        $curso = Course::findOrFail($curso_id);
        $modulo = Module::findOrFail($id);

        $sections = $modulo->sections;
        
        return view('cruds.mostrarSection', compact('sections','curso', 'modulo'));
    }

    public function create(Request $request, $curso_id, $id){
        $curso = Course::findOrFail($curso_id);
        $modulo = Module::findOrFail($id);

        $content = new Content();
        $content->text = 'Prueba de texto';
        $content->image = 'Prueba de imagen';
        $content->code = 'Prueba de code';
        $content->save();

        $section = new Section();
        $section->name = $request->name;
        $section->module_id = $modulo->id;
        $section->content_id = $content->id;
        $section->type = $request->type;
        $section->save();

        return redirect()->route('crudscursos.section', ['curso_id' => $curso_id, 'id' => $id]);
    }

    public function editar($curso_id, $id, $section_id){
        $curso = Course::findOrFail($curso_id);
        $modulo = Module::findOrFail($id);
        $section = Section::findOrFail($section_id);

        return view('cruds.editSection', compact('curso', 'modulo', 'section'));
    }

    public function update(Request $request, $curso_id, $id, $section_id) {
        $curso = Course::findOrFail($curso_id);
        $modulo = Module::findOrFail($id);
    
        $section = Section::where('module_id', $id)->where('id', $section_id)->firstOrFail();
    
        $section->name = $request->name;
        $section->type = $request->type;
        $section->save();
    
        return redirect()->route('crudscursos.section', ['curso_id' => $curso_id, 'id' => $id]);
    }

    public function destroy($curso_id, $id, $section_id)
    {
        $curso = Course::findOrFail($curso_id);
        $modulo = Module::findOrFail($id);
        $seccion = Section::findOrFail($section_id);

        $seccion->delete();

        return redirect()->route('crudscursos.section', [
            'curso_id' => $curso_id,
            'id' => $id
        ])->with('success', 'Pregunta eliminada correctamente');
    }

    public function editContents($curso_id, $id, $section_id, $content_id)
    {
        $curso = Course::findOrFail($curso_id);
        $modulo = Module::findOrFail($id);
        $section = Section::findOrFail($section_id);
        $content = Content::findOrFail($content_id);
        
        return view('cruds.editContent', compact('content','section','curso', 'modulo'));
    }

    public function updateContents(Request $request, $curso_id, $id, $section_id, $content_id){

        $content = Content::findOrFail($content_id);
        $content->text = $request->text;
        $content->image = $request->image;
        $content->code = $request->code;
        $content->save();
        

        return redirect()->route('editarContenido', ['curso_id' => $curso_id, 'id' => $id, 'section_id' => $section_id, 'content_id' => $content_id]);
    }
}
