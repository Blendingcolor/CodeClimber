@extends('layouts.CrudForm')
@section('formName')
    Edición de modulo
@endsection
@section('menus')
    {{-- <x-botonFlotante clases="top-4 left-4" href="{{ route('crudscursos.mostrar', ['id' => $curso->id]) }}">
        <i class="text-[1.5rem] bi bi-arrow-left"></i>
    </x-botonFlotante>
    <x-botonFlotante clases="top-4 right-5" href="#">
        <i class="text-[2rem] bi bi-person-fill"></i>  
    </x-botonFlotante> --}}
@endsection
@section('formContent')
    <header>
        <h1 class="mb-4 text-5xl font-extrabold text-center font-crud text-jsColor-0">EDITAR MÓDULO</h1>
    </header>
    <form class="bg-[#18181B] p-6 rounded-lg shadow-lg font-text space-y-6 text-xl w-[80%]" method="POST"
    action="{{ route('crudscursos.modulos.update', ['curso_id' => $curso->id, 'id' => $modulo->id]) }}">
    @csrf
    <div class="flex flex-col w-full">
        <label for="descripcion" class="inline-block w-32 text-white/85">Descripción:</label>
        <input type="text" id="descripcion" class="w-full h-12 px-1 mt-2 text-lg bg-black rounded-sm" name="descripcion" value="{{ $modulo->descripcion }}"
            autocomplete="off" required>
    </div>
    <div class="flex flex-col w-full">
        <label for="video" class="inline-block w-32 text-white/85">Video:</label>
        <input type="text" id="video" class="w-full h-12 px-1 mt-2 text-lg bg-black rounded-sm" name="video" value="{{ $modulo->video }}"
            autocomplete="off" required>
    </div>
    <div class="flex flex-col w-full">
        <label for="audio" class="inline-block w-32 text-white/85">Descripción:</label>
        <input type="text" id="audio" class="w-full h-12 px-1 mt-2 text-lg bg-black rounded-sm" name="audio" value="{{ $modulo->audio }}"
            autocomplete="off" required>
    </div>
    <div class="w-full text-center">
        <button type="submit" class="text-xl transition-all w-[15rem] hover:scale-110 rounded text-black bg-[#FFFF44] hover:bg-transparent hover:border-[#FFFF44] hover:border-[2px] hover:text-[#FFFF44] py-1 px-2 font-serif">Actualizar Módulo</button>
    </div>
    </form>
@endsection
