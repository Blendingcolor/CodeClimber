@extends('layouts.CrudForm')
@section('formName')
    Edición de examen clasificatorio
@endsection
@section('backRoute')
    {{route('crudsclasificatorio.listado')}}
@endsection
@section('formContent')
    <div>
        <header>
            <h1 class="font-crud text-jsColor-0 mb-4 text-center text-5xl font-extrabold">EDITAR PREGUNTA / ALTERNATIVAS</h1>
        </header>
        <div>
            <form class="crudForm" id="editPreguntaForm" method="POST"
                action="{{ route('crudsclasificatorio.update', $pregunta->id) }}">
                <h2 class="text-center text-4xl font-crud font-semibold">Pregunta</h2>
                @csrf
                <!-- No usar método PUT aquí, solo POST -->
                <div>
                    <label for="texto" class="crudLabel">Texto: </label>
                    <input type="text" class="crudInput1" id="texto" name="texto"
                        value="{{ old('texto', $pregunta->Texto) }}" placeholder="Ejm: ¿Qué es el DOM?" autocomplete="off"
                        required>
                </div>
                <div>
                    <label for="grupo" class="crudLabel">Grupo: </label>
                    <input type="text" class="crudInput1 mb-6" id="grupo" name="grupo"
                        value="{{ old('grupo', $pregunta->Grupo) }}" placeholder="Ejm: JavaScript" autocomplete="off"
                        required>
                </div>
                <div id="respuestas">
                    <h2 class="w-full pt-4 mb-2 text-center text-4xl font-crud font-semibold border-t-2 border-white/50">Alternativas</h2>
                    @foreach ($pregunta->respuestas as $respuesta)
                        <div class="space-y-4">
                            <label class="crudLabel" for="respuesta_texto_{{ $respuesta->id }}">Respuesta
                                {{ $loop->iteration }}</label>
                            <input class="crudInput mr-4" type="text" id="respuesta_texto_{{ $respuesta->id }}"
                                name="respuestas[{{ $respuesta->id }}][texto]"
                                value="{{ old('respuestas.' . $respuesta->id . '.texto', $respuesta->Texto) }}" required>
                            <input type="radio" id="correcta_{{ $respuesta->id }}" name="correcta"
                                value="{{ $respuesta->id }}"
                                {{ old('correcta', $pregunta->respuestas->where('Valor', 1)->first()->id ?? null) == $respuesta->id ? 'checked' : '' }}
                                required>

                            <label class="crudLabel" for="correcta_{{ $respuesta->id }}">¿Es correcta?</label>
                        </div>
                    @endforeach
                </div>
                <div class="w-full text-center">
                    <button
                        class="crudButton"
                        type="submit">Modificar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
