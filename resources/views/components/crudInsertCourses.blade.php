<label id="insertButton" for="insertBox"
        class="transition-all w-fit font-button p-2 border-2 border-xl rounded-md text-start text-2xl bg-green-400/45 cursor-pointer relative z-50 hover:bg-green-500/65">Agregar curso</label>
    <div
        class="fixed top-0 right-0 h-screen w-screen bg-gradient-to-b from-black/80 to-gray-900 transition-all duration-300 ease-in-out peer-checked:backdrop-blur-sm translate-y-full peer-checked:translate-y-0 z-40 shadow-xl shadow-black">
        <div class="flex flex-col w-full h-full justify-center items-center">
            <h2 class="text-4xl mb-6 text-white font-crud font-semibold">Insertar curso</h2>
            <form
                class="bg-black/25 p-6 border-white/50 border-2 rounded-lg shadow-lg shadow-white/25 font-text space-y-6 text-xl"
                id="createCursoForm" method="POST" action={{route('crudscursos.create')}}>
                @csrf
                <div>
                    <label for="name" class="inline-block w-32 text-white/85">Nombre:</label>
                    <input class="bg-black border-white/50 border-2 rounded-sm px-1 text-lg w-72" type="text"
                        id="name" placeholder="Ejm: PHP" name="name" autocomplete="off" required>
                </div>
                <div>
                    <label for="description" class="inline-block w-32 text-white/85">Descripción:</label>
                    <input class="bg-black border-white/50 border-2 rounded-sm px-1 text-lg w-72" type="text"
                        id="description" name="description" placeholder="Ejm: Curso de PHP" autocomplete="off" required>
                </div>
                <div>
                    <label for="precio" class="inline-block w-32 text-white/85">Precio:</label>
                    <input class="bg-black border-white/50 border-2 rounded-sm px-1 text-lg w-72" type="text"
                        id="precio" name="precio" placeholder="Ejm: 75" autocomplete="off" required>
                </div>
                <div>
                    <label for="image" class="inline-block w-32 text-white/85">Imagen:</label>
                    <input class="bg-black border-white/50 border-2 rounded-sm px-1 text-lg w-72" type="text"
                        id="image" placeholder="Ejm: patito.png" name="image" autocomplete="off" required>
                </div>
                <div class="w-full text-center">
                    <button
                        class="text-xl transition-all py-1 px-2 rounded-md bg-amber-500 hover:bg-amber-600 font-serif focus:shadow-inner focus:shadow-black/75"
                        type="submit">Insertar</button>
                </div>
            </form>
        </div>
    </div>