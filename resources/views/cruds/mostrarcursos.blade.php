@extends('layouts.Crud')
@section('agregarNav')
{{-- <x-botonFlotante clases="top-4 left-4" href="{{ route('crudscursos.listado') }}">
    <i class="text-[1.5rem] bi bi-arrow-left"></i>
</x-botonFlotante>
<x-botonFlotante clases="top-4 right-5" href="#">
    <i class="text-[2rem] bi bi-person-fill"></i>  
</x-botonFlotante> --}}
@endsection

@section('titulo', 'Crud de modulos')

@section('nombreCrud')
    CRUD DE MODULOS
@endsection

@section('insertar')
    <x-crudInsertModules :formRoute="route('crudscursos.modulos.store', $curso->id)" />
@endsection

@section('columnas')
<x-crudHeader class=" border-b-[2px] text-[1.2rem] border-[#424141] rounded-tl-[0.8rem]">Nombre</x-crudHeader>
<x-crudHeader class=" border-b-[2px] text-[1.2rem] border-[#424141] rounded-tl-[0.8rem]">Video</x-crudHeader>
<x-crudHeader class=" border-b-[2px] text-[1.2rem] border-[#424141] rounded-tl-[0.8rem]">Audio</x-crudHeader>
<x-crudHeader class=" border-b-[2px] text-[1.2rem] border-[#424141] rounded-tr-[0.5rem]">Accion</x-crudHeader>
@endsection

@section('datos')
    @foreach ($curso->modules as $modulo)
        <tr class="text-center">
            <td class="p-1 border-b-[0.5px] border-[#4241415b] text-[1rem]">{{ $modulo->descripcion }}</td>
            <td class="p-1 border-b-[0.5px] border-[#4241415b] text-[1rem]">{{ $modulo->video }}</td>
            <td class="p-1 border-b-[0.5px] border-[#4241415b] text-[1rem]">{{ $modulo->audio }}</td>
            <td class="p-1 border-b-[0.5px] border-[#4241415b] text-[1rem]">
                <div class="flex justify-center">
                    <div class="relative flex flex-col items-center justify-center ">
                        <input type="checkbox" id="showOptions_{{ $modulo->id }}" class="hidden peer">
                        <label id="iconButton_{{ $modulo->id }}" class="flex items-center justify-center h-8 py-1 m-2 transition-all duration-200 ease-in-out rounded-md cursor-pointer iconButton bg-jsColor-0 w-28 hover:shadow-black/50 hover:shadow-inner focus:bg-yellow-400" for="showOptions_{{ $modulo->id }}">
                            <div class="relative">
                                <img class="z-10 w-4 transition-all duration-200 rotate-180" src="{{ asset('images/icons/triangle.png') }}" alt="icon">
                            </div>
                        </label>
                        <div class="absolute top-0 p-2 opacity-0 max-h-0 bg-black/45 rounded-xl text-center text-lg overflow-hidden transition-all duration-300 ease-in-out peer-checked:opacity-100 peer-checked:max-h-screen peer-checked:translate-y-12 peer-checked:translate-x-0 z-[-10] peer-checked:z-10">
                            <a class="block transition-all duration-200 bg-black border-2 text-jsColor-0 px-2 border-jsColor-0 rounded-lg hover:shadow-inner hover:shadow-jsColor-0/80 mb-[4px]" href="{{ route('crudscursos.modulos.editar', ['curso_id' => $curso->id, 'id' => $modulo->id]) }}">Editar</a>
                            <a class="block mt-1 transition-all duration-200 bg-black border-2 text-green-400 px-2 border-green-400 rounded-lg hover:shadow-inner hover:shadow-green-400/80 mb-[5px]" href="{{ route('crudscursos.section', ['curso_id' => $curso->id, 'id' => $modulo->id]) }}">Ver</a>
                            <a class="block transition-all duration-200 bg-black border-2 text-blue-500 px-2 border-blue-500 rounded-lg hover:shadow-inner hover:shadow-jsColor-0/80 mb-[5px]" href="{{ route('crudscursos.examen.mostrar', ['curso_id' => $curso->id, 'id' => $modulo->id, 'exam_id' => $modulo->id]) }}">Examen</a>
                            <form action="{{ route('crudscursos.modulos.destroy', ['curso_id' => $curso->id, 'id' => $modulo->id]) }}" method="POST">
                                @csrf
                                <button class="block px-2 mt-1 text-red-500 transition-all duration-200 bg-black border-2 border-red-500 rounded-lg hover:shadow-inner hover:shadow-red-500/80" id="deleteButton_{{ $modulo->id }}" type="submit">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    <!-- Modal de agregar módulo -->
    <div id="modalAgregarModulo" style="display: none;">
        <div>
            <div>
                <button type="button" id="closeModalButton">Cerrar</button>
            </div>
            <div>
                <form action="{{ route('crudscursos.modulos.store', $curso->id) }}" method="POST">
                    @csrf
                    <div>
                        <label for="descripcion">Descripción</label>
                        <input type="text" name="descripcion" id="descripcion" required>
                    </div>
                    <div>
                        <label for="video">Video</label>
                        <input type="text" name="video" id="video" required>
                    </div>
                    <div>
                        <label for="audio">Audio</label>
                        <input type="text" name="audio" id="audio" required>
                    </div>
                    <button type="submit"><i class="bi bi-plus"></i></button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const curso = @json($curso);

            // Seleccionar todos los icon buttons
            const iconButtons = document.querySelectorAll('.iconButton');
            iconButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Desmarcar todos los checkboxes excepto el actual
                    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                        if (checkbox !== button.previousElementSibling) {
                            checkbox.checked = false;
                            checkbox.dispatchEvent(new Event('change')); // Forzar el evento 'change' para que las transiciones se apliquen
                        }
                    });
                    // Alternar la rotación del icono actual
                    button.children[0].children[0].classList.toggle('rotate-180');
                });
            });

            curso.modules.forEach(modulo => {
                const deleteButton = document.getElementById(`deleteButton_${modulo.id}`);
                const iconButton = document.getElementById(`iconButton_${modulo.id}`);

                // Agregar evento de clic para el botón de eliminar
                deleteButton.addEventListener('click', function(event) {
                    const confirmado = confirm("¿Realmente desea eliminar este módulo?");
                    if (!confirmado) {
                        event.preventDefault();
                    }
                });

                // Agregar evento de clic para el botón del icono
                iconButton.addEventListener('click', function() {
                    iconButton.children[0].children[0].classList.toggle('rotate-180');
                });
            });

            // Cambiar el contenido de texto de insertButton cuando se abra el formulario de inserción de módulos
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

            // Controlar la apertura y cierre del modal de agregar módulo
            const openModalButton = document.getElementById('openModalButton');
            const closeModalButton = document.getElementById('closeModalButton');
            const modalAgregarModulo = document.getElementById('modalAgregarModulo');

            openModalButton.addEventListener('click', () => {
                modalAgregarModulo.style.display = 'block';
            });

            closeModalButton.addEventListener('click', () => {
                modalAgregarModulo.style.display = 'none';
            });
        });
    </script>
@endsection
