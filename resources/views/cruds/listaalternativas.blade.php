@extends('layouts.Crud')
@section('agregarNav')
<x-botonFlotante clases="top-4 left-4" href="{{ route('crudscursos.examen.mostrar', ['curso_id' => $curso->id, 'id' => $modulo->id, 'exam_id' => $examen->id]) }}">
    <i class="text-[1.5rem] bi bi-arrow-left"></i>
</x-botonFlotante>
<x-botonFlotante clases="top-4 right-5" href="#">
    <i class="text-[2rem] bi bi-person-fill"></i>  
</x-botonFlotante>
@endsection
@section('titulo', 'Listado de Alternativas')
@section('nombreCrud')
ALTERNATIVAS
@endsection
@section('columnas')
    <x-crudHeader class="border-b-[2px] text-[1.2rem] border-[#424141] rounded-tl-[0.8rem]">Alternativas</x-crudHeader>
    <x-crudHeader class="border-b-[2px] text-[1.2rem] border-[#424141] rounded-tr-[0.5rem]">Acciones</x-crudHeader>
@endsection
@section('datos')
    @foreach ($alternativas as $alternativa)
    <tr class="text-center">
        <td class="p-1 border-b-[0.5px] border-[#4241415b] text-[1rem]">{{ $alternativa->alternative }}</td>
        <td class="border-b-[0.5px] border-[#4241419d]  p-1 text-[1rem] relative flex justify-center items-center">
            <a href="{{ route('crudscursos.alternativa.editar', ['curso_id' => $curso->id, 'id' => $modulo->id, 'exam_id' => $examen->id, 'question_id' => $pregunta->id, 'alternative_id' => $alternativa->id]) }}" class="text-black border-[#FFFF44] border-[1px] bg-[#FFFF44] rounded w-[10rem] hover:bg-black hover:text-[#FFFF44] duration-400">Editar</a>
        </td>
    </tr>
    @endforeach
    @if($alternativas->isEmpty())
        <h3>ingrese alternativas</h3>
    @else
        <a href="{{ route('crudscursos.respuesta.editar', ['curso_id' => $curso->id, 'id' => $modulo->id, 'exam_id' => $examen->id, 'question_id' => $pregunta->id, 'alternative_id' => $alternativa->id, 'answer_id'=> $respuesta]) }}" class="transition-all w-fit font-button p-2 border-2 border-xl rounded-lg text-start text-2xl cursor-pointer relative z-50 bg-[#FFFF44] text-black border-[#FFFF44] hover:text-[#FFFF44] hover:border-[#FFFF44] hover:bg-transparent duration-300"><i class="bi bi-clipboard-check"></i></i></a>
    @endif
@endsection
