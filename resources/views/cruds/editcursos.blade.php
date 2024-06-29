@extends('layouts.CrudForm')
@section('formName')
    Edición de curso
@endsection
@section('menus')
<x-botonFlotante clases="top-4 left-4" href="{{ route('crudscursos.listado') }}">
    <i class="text-[1.5rem] bi bi-arrow-left"></i>
</x-botonFlotante>
<x-botonFlotante clases="top-4 right-5" href="#">
    <i class="text-[2rem] bi bi-person-fill"></i>  
</x-botonFlotante>
@endsection
@section('formContent')
    <header>
        <h1 class="mb-4 text-5xl font-extrabold text-center font-crud text-jsColor-0">EDITAR CURSO</h1>
    </header>
    <form class="bg-[#18181B] p-6 rounded-lg shadow-lg font-text space-y-6 text-xl w-[80%]"
    id="createCursoForm" method="POST" action="{{ route('crudscursos.update', $curso->id) }}">
    @csrf
    <div class="flex flex-col w-full">
        <label for="name" class="inline-block w-32 text-white/85">Nombre:</label>
        <input class="w-full h-12 px-1 mt-2 text-lg bg-black rounded-sm" type="text"
            id="name" name="name" autocomplete="off" value="{{ $curso->name }}" required>
    </div>
    <div class="flex flex-col w-full">
        <label for="description" class="inline-block w-32 text-white/85">Descripción(50l):</label>
        <textarea class="mt-2 w-full max-h-[4rem] bg-black rounded-sm px-1 text-lg"
            id="description" name="description" maxlength="50" autocomplete="off" required>{{ $curso->description }}</textarea>
    </div>
    <div class="flex flex-col w-full">
        <label for="precio" class="inline-block w-32 text-white/85">Precio:</label>
        <input class="w-full h-12 px-1 mt-2 text-lg bg-black rounded-sm" type="number"
            id="precio" name="precio" placeholder="Ejm: 75" autocomplete="off" min="0" value="{{ $curso->precio }}" required>
    </div>
    <div class="flex flex-col w-full">
        <label for="image" class="inline-block w-32 text-white/85">Imagen:</label>
        <input class="w-full h-12 px-1 mt-2 text-lg bg-black rounded-sm" type="text"
            id="image" placeholder="Ejm: patito.png" name="image" autocomplete="off" value="{{ $curso->image }}" required>
    </div>
    <div>
        <label for="period" class="inline-block w-32 text-white/85">Periodo:</label>
        <input type="number" id="period" class="w-full h-12 px-1 mt-2 text-lg bg-black rounded-sm" name="period"
            value="{{ $curso->period }}" autocomplete="off" required>
    </div>
    <div>
        <label for="color" class="inline-block w-32 text-white/85">Color:</label>
        <input type="text" id="color" class="w-full h-12 px-1 mt-2 text-lg bg-black rounded-sm" name="color"
            value="{{ $curso->color }}" autocomplete="off" required>
    </div>
    <div class="w-full text-center">
        <button
            class="text-xl transition-all w-[15rem] hover:scale-110 rounded text-black bg-[#FFFF44] hover:bg-transparent hover:border-[#FFFF44] hover:border-[2px] hover:text-[#FFFF44] py-1 px-2 font-serif"
            type="submit">Actualizar Curso
        </button>
    </div>
</form>

@endsection
