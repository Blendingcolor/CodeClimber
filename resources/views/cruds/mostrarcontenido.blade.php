@extends('layouts.CrudForm')
@section('formName')
    Creación de contenido de módulo
@endsection
@section('menus')
<x-botonFlotante clases="top-4 left-4" href="{{ route('crudscursos.mostrar', ['id' => $curso->id]) }}">
    <i class="text-[1.5rem] bi bi-arrow-left"></i>
</x-botonFlotante>
<x-botonFlotante clases="top-4 right-5" href="#">
    <i class="text-[2rem] bi bi-person-fill"></i>  
</x-botonFlotante>
@endsection
@section('formContent')
<header class="flex flex-row items-center justify-around w-full ">
    <h1 class="mb-4 text-xl font-extrabold font-crud text-[#8C8C8D]">CURSO: {{ $curso->name }}</h1>
    <h2 class="mb-4 text-xl font-extrabold text-[#8C8C8D] font-crud">MÓDULO: {{ $modulo->descripcion }}</h2>
</header>
    @foreach ($contenidos as $contenido)

        <h3 class="mb-2 text-4xl font-bold text-center text-yellow-500 font-crud">CONTENIDO</h3>
        <form class="bg-[#18181B] p-6 rounded-lg shadow-lg font-text space-y-6 text-xl w-[80%]" action="{{ route('contenido.editar', $contenido->id) }}" method="POST">
            @csrf
            <div class="flex flex-col w-full">
                <label for="text" class="inline-block w-32 text-white/85">Texto:</label>
                <textarea class="w-full h-[10rem] px-1 mt-2 text-lg bg-black rounded max-h-[10rem] min-h-[9.9rem]" name="text" id="text" cols="30" rows="10" autocomplete="off">{{ $contenido->text }}</textarea>
            </div>
            <div class="flex flex-col w-full">
                <label for="image" class="inline-block w-32 text-white/85">Imagen:</label>
                <input type="text" id="image" name="image" class="w-full h-12 px-1 mt-2 text-lg bg-black rounded"
                    value="{{ $contenido->image }}" autocomplete="off">
            </div>
            <div class="flex flex-col w-full">
                <label for="video" class="inline-block w-32 text-white/85">Video:</label>
                <input type="text" id="video" name="video" class="w-full h-12 px-1 mt-2 text-lg bg-black rounded"
                    value="{{ $contenido->video }}" autocomplete="off">
            </div>
            <div class="w-full text-center">
                <button type="submit" class="text-xl transition-all w-[15rem] hover:scale-110 rounded text-black bg-[#FFFF44] hover:bg-transparent hover:border-[#FFFF44] hover:border-[2px] hover:text-[#FFFF44] py-1 px-2 font-serif">Guardar</button>
            </div>
        </form>

    @endforeach
@endsection
