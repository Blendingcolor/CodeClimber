<label id="insertButton" for="insertBox"
    class="transition-all w-fit font-button p-2 border-2 border-xl rounded-md text-start text-2xl bg-green-400/45 cursor-pointer relative z-50 hover:bg-green-500/65">Agregar
    examen</label>
<div
    class="fixed top-0 right-0 h-screen w-screen bg-gradient-to-b from-black/80 to-gray-900 transition-all duration-300 ease-in-out peer-checked:backdrop-blur-sm translate-y-full peer-checked:translate-y-0 z-40 shadow-xl shadow-black">
    <div class="flex flex-col w-full h-full justify-center items-center">
        <form
            class="bg-black/25 p-6 border-white/50 border-2 rounded-lg shadow-lg shadow-white/25 font-text space-y-6 text-xl"
            id="createPreguntaForm" method="POST" action={{ route('crudsclasificatorio.create') }}>
            <h2 class="text-center text-4xl font-crud font-semibold">Pregunta</h2>
            @csrf
            <div>
                <label for="texto" class="crudLabel">Texto: </label>
                <input type="text" class="crudInput1" id="texto" name="texto" placeholder="Ejm: ¿Qué es el DOM?" autocomplete="off" required>
            </div>
            <div>
                <label for="grupo" class="crudLabel">Grupo: </label>
                <input type="text" class="crudInput1 mb-6" id="grupo" name="grupo" placeholder="Ejm: JavaScript" autocomplete="off" required>
            </div>
            <div id="respuestas">
                <h2 class="w-full pt-4 mb-2 text-center text-4xl font-crud font-semibold border-t-2 border-white/50">Alternativas</h2>
                <label for="Respuestas"></label>
                @for ($i = 0; $i < 4; $i++)
                    <div class="space-y-4">
                        <label for="respuesta_texto_{{ $i }}" class="crudLabel">Respuesta
                            {{ $i + 1 }}:</label>
                        <input type="text" class="crudInput1 mr-2" id="respuesta_texto_{{ $i }}"
                            name="respuestas[{{ $i }}][texto]" placeholder="Ejm: Alternativa {{$i + 1}}" autocomplete="off" required>
                        <label for="correcta_{{ $i }}" class="form-label">¿Es correcta?</label>
                        <input type="radio"  id="correcta_{{ $i }}" name="correcta"
                            value="{{ $i }}" autocomplete="off" required>
                    </div>
                @endfor
            </div>
            <div class="w-full text-center">
                <button
                    class="crudButton"
                    type="submit">Insertar</button>
            </div>
        </form>
    </div>
</div>
