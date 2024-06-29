@extends('layouts.Crud')

@section('agregarNav')
<x-botonFlotante clases="top-4 left-4" href="{{ route('crudscursos.mostrar', ['id' => $curso->id]) }}">
    <i class="text-[1.5rem] bi bi-arrow-left"></i>
</x-botonFlotante>
<x-botonFlotante clases="top-4 right-5" href="#">
    <i class="text-[2rem] bi bi-person-fill"></i>  
</x-botonFlotante>
@endsection

@section('titulo', 'Listado de Preguntas de Examen')
@section('nombreCrud')
    PREGUNTAS DE EXAMEN
@endsection

@section('insertar')
<x-crudInsertarAlternativas 
    action="{{ route('crudscursos.examen.crear', ['curso_id' => $curso->id, 'id' => $modulo->id, 'exam_id' => $examen->id]) }}"
    label="Pregunta:"
    buttonText="Insertar"
></x-crudInsertarAlternativas>
@endsection

@section('columnas')
    <x-crudHeader class="border-b-[2px] text-[1.2rem] border-[#424141] rounded-tl-[0.8rem]">Pregunta</x-crudHeader>
    <x-crudHeader class="border-b-[2px] text-[1.2rem] border-[#424141] rounded-tr-[0.5rem]">Acciones</x-crudHeader>
@endsection

@section('datos')
    @foreach ($preguntas as $pregunta)
        <tr class="text-center">
            <td class="p-1 border-b-[0.5px] border-[#4241415b] text-[1rem]">{{ $pregunta->question }}</td>
            <td class="border-b-[0.5px] border-[#4241419d]  p-1 text-[1rem] relative">
                <div class="flex justify-center">
                    <input type="checkbox" id="showOptions{{ $pregunta->id }}" class="hidden peer">
                    <label id="iconButton{{ $pregunta->id }}"
                        class="flex items-center justify-center h-8 py-1 m-2 transition-all duration-200 ease-in-out rounded-md cursor-pointer iconButton bg-jsColor-0 w-28 hover:shadow-black/50 hover:shadow-inner focus:bg-yellow-400"
                        for="showOptions{{ $pregunta->id }}">
                        <div class="relative">
                            <img class="z-10 w-4 transition-all duration-200 rotate-180"
                                src="{{ asset('images/icons/triangle.png') }}" alt="icon">
                        </div>
                    </label>
                    <div
                        class="absolute p-2 opacity-0 max-h-0 bg-black/45 rounded-xl text-center text-lg overflow-hidden transition-all duration-300 ease-in-out peer-checked:opacity-100 peer-checked:max-h-screen peer-checked:translate-y-12 peer-checked:translate-x-0 z-[-10] peer-checked:z-10">
                        <a class="block transition-all duration-200 bg-black border-2 text-jsColor-0 px-2 border-jsColor-0 rounded-lg hover:shadow-inner hover:shadow-jsColor-0/80 mb-[4px]"
                        href="{{ route('crudscursos.examen.editar', ['curso_id' => $curso->id, 'id' => $modulo->id, 'exam_id' => $examen->id, 'question_id' => $pregunta->id]) }}">Editar</a>
                        <a class="block transition-all duration-200 bg-black border-2 text-green-400 px-2 border-green-400 rounded-lg hover:shadow-inner hover:shadow-green-400/80 mb-[5px]"
                        href="{{ route('crudscursos.alternativas.mostrar', ['curso_id' => $curso->id, 'id' => $modulo->id, 'exam_id' => $examen->id, 'question_id' => $pregunta->id]) }}">Alternativas</a>
                        <form action="{{ route('crudscursos.examen.destroy', ['curso_id' => $curso->id, 'id' => $modulo->id, 'exam_id' => $examen->id, 'question_id' => $pregunta->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button
                                class="block w-full px-2 text-red-500 transition-all duration-200 bg-black border-2 border-red-500 rounded-lg hover:shadow-inner hover:shadow-red-500/80"
                                type="submit">Eliminar</button>
                        </form>
                    </div>
                </div>
                {{-- <div class="flex justify-center">
                    <div class="relative flex flex-col items-center justify-center">
                        <input type="checkbox" id="showOptions_{{ $pregunta->id }}" class="hidden peer">
                        <label id="iconButton_{{ $pregunta->id }}"
                            class="flex items-center justify-center h-8 py-1 m-2 transition-all duration-200 ease-in-out rounded-md cursor-pointer iconButton bg-jsColor-0 w-28 hover:shadow-black/50 hover:shadow-inner focus:bg-yellow-400"
                            for="showOptions_{{ $pregunta->id }}">
                            <div class="relative">
                                <img class="z-10 w-4 transition-all duration-200 rotate-180"
                                    src="{{ asset('images/icons/triangle.png') }}" alt="icon">
                            </div>
                        </label>
                        <div
                            class="absolute top-0 p-2 opacity-0 max-h-0 bg-black/45 rounded-xl text-center text-lg overflow-hidden transition-all duration-300 ease-in-out peer-checked:opacity-100 peer-checked:max-h-screen peer-checked:translate-y-12 peer-checked:translate-x-0 z-[-10] peer-checked:z-10">
                            <a class="block transition-all duration-200 bg-black border-2 text-jsColor-0 px-2 border-jsColor-0 rounded-lg hover:shadow-inner hover:shadow-jsColor-0/80 mb-[4px]"
                                href="{{ route('crudscursos.examen.editar', ['curso_id' => $curso->id, 'id' => $modulo->id, 'exam_id' => $examen->id, 'question_id' => $pregunta->id]) }}">Editar</a>
                            <a class="block transition-all duration-200 bg-black border-2 text-green-400 px-2 border-green-400 rounded-lg hover:shadow-inner hover:shadow-green-400/80 mb-[5px]"
                                href="{{ route('crudscursos.alternativas.mostrar', ['curso_id' => $curso->id, 'id' => $modulo->id, 'exam_id' => $examen->id, 'question_id' => $pregunta->id]) }}">Alternativas</a>
                            <form action="{{ route('crudscursos.examen.destroy', ['curso_id' => $curso->id, 'id' => $modulo->id, 'exam_id' => $examen->id, 'question_id' => $pregunta->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button
                                    class="block w-full px-2 text-red-500 transition-all duration-200 bg-black border-2 border-red-500 rounded-lg hover:shadow-inner hover:shadow-red-500/80"
                                    type="submit">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div> --}}
            </td>
        </tr>
    @endforeach
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const preguntas = @json($preguntas);

            // Seleccionar todos los icon buttons
            const iconButtons = document.querySelectorAll('.iconButton');
            iconButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Desmarcar todos los checkboxes excepto el actual
                    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                        if (checkbox !== button.previousElementSibling) {
                            checkbox.checked = false;
                            checkbox.dispatchEvent(new Event(
                                'change'
                            )); // Forzar el evento 'change' para que las transiciones se apliquen
                        }
                    });
                    // Alternar la rotación del icono actual
                    button.children[0].children[0].classList.toggle('rotate-180');
                });
            });

            preguntas.forEach(pregunta => {
                const deleteButton = document.getElementById(`deleteButton_${pregunta.id}`);
                const iconButton = document.getElementById(`iconButton_${pregunta.id}`);

                // Agregar evento de clic para el botón de eliminar
                // deleteButton.addEventListener('click', function(event) {
                //     const confirmado = confirm("¿Realmente desea eliminar esta pregunta?");
                //     if (!confirmado) {
                //         event.preventDefault();
                //     }
                // });
                // Agregar evento de clic para el botón del icono
                iconButton.addEventListener('click', function() {
                    iconButton.children[0].children[0].classList.toggle('rotate-180');
                });
            });

            //Cambiar el contenido de texto de insertButton cuando se abra el formulario de inserción de preguntas
            const insertButton = document.getElementById("insertButton");
            let isOpen = false;

            function toggleButtonText() {
                if (!isOpen) {
                    insertButton.innerHTML = `<i class="bi bi-x-lg"></i>`;
                    isOpen = true;
                } else {
                    insertButton.innerHTML = `<i class="bi bi-plus"></i>`;
                    isOpen = false;
                }
            }

            insertButton.addEventListener("click", toggleButtonText);
        });
    </script>
@endsection
