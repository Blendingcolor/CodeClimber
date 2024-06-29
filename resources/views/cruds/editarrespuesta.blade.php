@extends('layouts.CrudForm')
@section('formName')
Editar Respuesta
@endsection
@section('menus')
    <x-botonFlotante clases="top-4 left-4" href="{{ route('crudscursos.alternativas.mostrar', ['curso_id' => $curso_id, 'id' => $modulo->id, 'exam_id' => $examen->id, 'question_id' => $pregunta->id]) }}">
        <i class="text-[1.5rem] bi bi-arrow-left"></i>
    </x-botonFlotante>
    <x-botonFlotante clases="top-4 right-5" href="#">
        <i class="text-[2rem] bi bi-person-fill"></i>  
    </x-botonFlotante>
@endsection
@section('formContent')
<header>
    <h1 class="mb-4 text-5xl font-extrabold text-center font-crud text-jsColor-0">Editar Respuesta</h1>
</header>
<form class="bg-[#18181B] p-6 rounded-lg shadow-lg font-text space-y-6 text-xl w-[80%]" action="{{ route('crudscursos.respuesta.actualizar', ['curso_id' => $curso_id, 'id' => $modulo->id, 'exam_id' => $examen->id, 'question_id' => $pregunta->id, 'alternative_id' =>$alternativa->id ,'respuesta_id' => $respuesta->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="flex flex-col w-full">
        <label for="answer" class="inline-block w-32 text-white/85">Descripción:</label>
        <input type="text" id="answer" class="w-full h-12 px-1 mt-2 text-lg bg-black rounded-sm" name="answer" value="{{ old('respuesta', $respuesta->answer) }}" required>
    </div>
    <div class="w-full text-center">
        <button type="submit" class="text-xl transition-all w-[15rem] hover:scale-110 rounded text-black bg-[#FFFF44] hover:bg-transparent hover:border-[#FFFF44] hover:border-[2px] hover:text-[#FFFF44] py-1 px-2 font-serif">Actualizar Respuesta</button>
    </div>
</form>
@endsection