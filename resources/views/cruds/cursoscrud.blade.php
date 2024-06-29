@extends('layouts.Crud')

@section('titulo', 'Crud de cursos')

@section('nombreCrud')
    CRUD DE CURSOS
@endsection

@section('insertar')
    <x-crudInsertCourses/>
@endsection

@section('columnas')
    <x-crudHeader class=" border-b-[2px] text-[1.2rem] border-[#424141] rounded-tl-[0.8rem]">Nombre</x-crudHeader>
    <x-crudHeader class=" border-b-[2px] text-[1.2rem] border-[#424141] ">Descripcion</x-crudHeader>
    <x-crudHeader class=" border-b-[2px] text-[1.2rem] border-[#424141] ">Precio</x-crudHeader>
    <x-crudHeader class=" border-b-[2px] text-[1.2rem] border-[#424141] ">Imagen</x-crudHeader>
    <x-crudHeader class=" border-b-[2px] text-[1.2rem] border-[#424141] ">Periodo</x-crudHeader>
    <x-crudHeader class=" border-b-[2px] text-[1.2rem] border-[#424141] ">Color</x-crudHeader>
    <x-crudHeader class=" border-b-[2px] text-[1.2rem] border-[#424141] rounded-tr-[0.5rem]">Accion</x-crudHeader>
@endsection

@section('datos')
    @foreach ($cursos as $curso)
        <tr class="text-center">
            <td class="p-1 border-b-[0.5px] border-[#4241415b] text-[1rem]">{{ $curso->name }}</td>
            <td class="p-1 border-b-[0.5px] border-[#4241415b] text-[1rem]">{{ $curso->description }}</td>
            <td class="p-1 border-b-[0.5px] border-[#4241415b] text-[1rem]">{{ $curso->precio }}</td>
            <td class=" border-b-[0.5px] border-[#4241415b] w-full flex justify-center p-1 text-[1rem]"> <img class="w-[10rem] h-auto mt-1 mb-1 rounded-lg object-contain" src="{{ $curso->image }}" alt="image"></td>
            <td class="p-1 border-b-[0.5px] border-[#4241415b] text-[1rem]">{{ $curso->period }}</td>
            <td class="p-1 border-b-[0.5px] border-[#4241415b] text-[1rem]">{{ $curso->color }}</td>
            <td class="border-b-[0.5px] border-[#4241415b] p-1 text-[1rem] relative">
                <div class="flex justify-center">
                    <input type="checkbox" id="showOptions{{ $curso->id }}" class="hidden peer">
                    <label id="iconButton{{ $curso->id }}"
                        class="flex items-center justify-center h-8 py-1 m-2 transition-all duration-200 ease-in-out rounded-md cursor-pointer iconButton bg-jsColor-0 w-28 hover:shadow-black/50 hover:shadow-inner focus:bg-yellow-400"
                        for="showOptions{{ $curso->id }}">
                        <div class="relative">
                            <img class="z-10 w-4 transition-all duration-200 rotate-180"
                                src="{{ asset('images/icons/triangle.png') }}" alt="icon">
                        </div>
                    </label>
                    <div
                        class="absolute p-2 opacity-0 max-h-0 bg-black/45 rounded-xl text-center text-lg overflow-hidden transition-all duration-300 ease-in-out peer-checked:opacity-100 peer-checked:max-h-screen peer-checked:translate-y-12 peer-checked:translate-x-0 z-[-10] peer-checked:z-10">
                        <a class="block transition-all duration-200 bg-black border-2 text-jsColor-0 px-2 border-jsColor-0 rounded-lg hover:shadow-inner hover:shadow-jsColor-0/80 mb-[4px]"
                            href="{{ route('crudscursos.editar', $curso->id) }}">Editar</a>
                        <a class="block transition-all duration-200 bg-black border-2 text-green-400 px-2 border-green-400 rounded-lg hover:shadow-inner hover:shadow-green-400/80 mb-[5px]"
                            href="{{ route('crudscursos.mostrar', $curso->id) }}">Ver</a>
                        <form action="{{ route('crudscursos.eliminar', $curso->id) }}" method="POST">
                            @csrf
                            <button
                                class="block px-2 text-red-500 transition-all duration-200 bg-black border-2 border-red-500 rounded-lg hover:shadow-inner hover:shadow-red-500/80"
                                id="deleteButton{{ $curso->id }}" type="submit">Eliminar</button>
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
            const cursos = @json($cursos);

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

            cursos.forEach(curso => {
                const deleteButton = document.getElementById(`deleteButton_${curso.id}`);
                const iconButton = document.getElementById(`iconButton_${curso.id}`);

                // Agregar evento de clic para el botón de eliminar
                deleteButton.addEventListener('click', function(event) {
                    const confirmado = confirm("¿Realmente desea eliminar este curso?");
                    if (!confirmado) {
                        event.preventDefault();
                    }
                });

                // Agregar evento de clic para el botón del icono
                iconButton.addEventListener('click', function() {
                    iconButton.children[0].children[0].classList.toggle('rotate-180');
                });
            });

            //Cambiar el contenido de texto de insertButton cuando se abra el formulario de inserción de cursos
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
