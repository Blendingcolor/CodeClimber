@extends('layouts.Crud')

@section('nombreCrud')
    PREGUNTAS CLASIFICATORIAS
@endsection

@section('insertar')
    <x-crudInsertClasificatorio />
@endsection

@section('columnas')
    <x-crudHeader nombreHeader="Texto" />
    <x-crudHeader nombreHeader="Grupo" />
    <x-crudHeader nombreHeader="Accion" />
@endsection

@section('datos')
    @foreach ($preguntas as $pregunta)
        <tr class="text-center">
            <td class="border-2 p-1">{{ $pregunta->Texto }}</td>
            <td class="border-2 p-1">{{ $pregunta->Grupo }}</td>
            <td class="border-2 p-1 relative">
                <div class="flex justify-center">
                    <input type="checkbox" id="showOptions_{{ $pregunta->id }}" class="peer hidden">
                    <label id="iconButton_{{ $pregunta->id }}"
                        class="iconButton flex justify-center items-center transition-all duration-200 ease-in-out bg-jsColor-0 w-28 h-8 py-1 m-2 rounded-md cursor-pointer hover:shadow-black/50 hover:shadow-inner focus:bg-yellow-400"
                        for="showOptions_{{ $pregunta->id }}">
                        <div class="relative">
                            <img class="z-10 transition-all duration-200 w-4 rotate-180"
                                src="{{ asset('images/icons/triangle.png') }}" alt="icon">
                        </div>
                    </label>
                    <div
                        class="absolute top-0 p-2 opacity-0 max-h-0 bg-black/45 rounded-xl text-center text-lg overflow-hidden transition-all duration-300 ease-in-out peer-checked:opacity-100 peer-checked:max-h-screen peer-checked:translate-y-12 peer-checked:translate-x-0 z-[-10] peer-checked:z-10">
                        <a class="block transition-all duration-200 bg-black border-2 text-jsColor-0 px-2 border-jsColor-0 rounded-lg hover:shadow-inner hover:shadow-jsColor-0/80 mb-[4px]"
                        href="{{ route('crudsclasificatorio.editar', $pregunta->id) }}">Editar</a>
                        <form action="{{ route('crudsclasificatorio.eliminar', $pregunta->id) }}" method="POST">
                            @csrf
                            <button
                                class="block mt-1 transition-all duration-200 bg-black border-2 text-red-500 px-2 border-red-500 rounded-lg hover:shadow-inner hover:shadow-red-500/80 z-[-10] peer-checked:z-10"
                                id="deleteButton_{{ $pregunta->id }}" type="submit">Eliminar</button>
                        </form>
                    </div>
                </div>
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
                deleteButton.addEventListener('click', function(event) {
                    const confirmado = confirm("¿Realmente desea eliminar este examen?");
                    if (!confirmado) {
                        event.preventDefault();
                    }
                });

                // Agregar evento de clic para el botón del icono
                iconButton.addEventListener('click', function() {
                    iconButton.children[0].children[0].classList.toggle('rotate-180');
                });
            });

            //Cambiar el contenido de texto de insertButton cuando se abra el formulario de inserción de examenes
            const insertButton = document.getElementById("insertButton");
            let isOpen = false;

            function toggleButtonText() {
                if (!isOpen) {
                    insertButton.textContent = "Cerrar";
                    isOpen = true;
                } else {
                    insertButton.textContent = "Agregar examen";
                    isOpen = false;
                }
            }
            insertButton.addEventListener("click", toggleButtonText);
        });
    </script>
@endsection
