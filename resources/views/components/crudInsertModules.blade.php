<label id="insertButton" for="insertBox"
    class="transition-all w-fit font-button p-2 border-2 border-xl rounded-md text-start text-2xl bg-green-400/45 cursor-pointer relative z-50 hover:bg-green-500/65">Agregar
    modulo</label>
<div
    class="fixed top-0 right-0 h-screen w-screen bg-gradient-to-b from-black/80 to-gray-900 transition-all duration-300 ease-in-out peer-checked:backdrop-blur-sm translate-y-full peer-checked:translate-y-0 z-40 shadow-xl shadow-black">
    <div class="flex flex-col w-full h-full justify-center items-center">
        <h2 class="text-4xl mb-6 text-white font-crud font-semibold">Insertar modulo</h2>
        <form
            class="bg-black/25 p-6 border-white/50 border-2 rounded-lg shadow-lg shadow-white/25 font-text space-y-6 text-xl"
            id="createCursoForm" method="POST" action={{ $formRoute }}>
            @csrf
            <div class="mb-3">
                <label for="descripcion" class="inline-block w-32 text-white/85">Descripcion</label>
                <input class="bg-black border-white/50 border-2 rounded-sm px-1 text-lg w-72" type="text"
                    id="descripcion" name="descripcion" placeholder="Ejm: Manipulacion del DOM" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label for="video" class="inline-block w-32 text-white/85">Video</label>
                <input class="bg-black border-white/50 border-2 rounded-sm px-1 text-lg w-72" type="text"
                    id="video" name="video" placeholder="Ejm: patito.com" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label for="audio" class="inline-block w-32 text-white/85">Audio</label>
                <input class="bg-black border-white/50 border-2 rounded-sm px-1 text-lg w-72" type="text"
                    id="audio" name="audio" placeholder="Ejm: pedrito.com" autocomplete="off" required>
            </div>

            <div class="w-full text-center">
                <button
                    class="text-xl transition-all py-1 px-2 rounded-md bg-amber-500 hover:bg-amber-600 font-serif focus:shadow-inner focus:shadow-black/75"
                    type="submit">Insertar</button>
            </div>
        </form>
    </div>
</div>
