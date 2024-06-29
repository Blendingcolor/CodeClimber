<!-- Contenido de cada módulo -->
<div class="bg-[rgba(255,255,255,0.10)] h-screen">
    <!-- Metodos de aprendizaje, cabecera -->
    <header>
        <h1 class="flex justify-center pt-4 font-mono text-2xl text-center lg:text-xl">MÉTODO DE APRENDIZAJE</h1>
        <div class="flex flex-row justify-around h-10">
            <div
                class="transition-colors duration-250 flex flex-row items-center justify-center text-lg us:text-base w-2/6 bg-[rgba(255,255,255,0.45)] hover:bg-[rgba(255,255,255,0.55)] focus:bg-[rgba(255,255,255,0.70)] cursor-pointer">
                <img class="w-6 mr-1" src="{{ asset('images/icons/textMode.svg') }}" alt="ModoTexto">Texto
            </div>
            <div id="audio-button"
                class="transition-colors duration-250 flex flex-row items-center justify-center text-lg us:text-base w-2/6 bg-[rgba(255,255,255,0.15)] hover:bg-[rgba(255,255,255,0.35)] focus:bg-[rgba(255,255,255,0.45)] cursor-pointer">
                <img id="audio-icon" class="w-6 mr-1 transition-all duration-150"
                    src="{{ asset('images/icons/audioOff.svg') }}" alt="ModoAudio">Audio
            </div>
            <div id="video-button"
                class="transition-colors duration-250 flex flex-row items-center justify-center text-lg us:text-base w-2/6 bg-[rgba(255,255,255,0.15)] hover:bg-[rgba(255,255,255,0.35)] focus:bg-[rgba(255,255,255,0.45)] cursor-pointer">
                <img class="w-6 mr-1" src="{{ asset('images/icons/video.svg') }}" alt="ModoVideo">Video
            </div>
        </div>
    </header>
    <div id="ModuleElements" class="absolute bottom-0 left-0 right-0 px-20 py-6 overflow-auto xl:px-10 top-24">
        <!-- Sections -->
        <div id="sections" class="flex flex-col space-y-4">
            <!-- Content peer section -->
        </div>
        <!-- Examen -->
        @if (!$existingMP)
            <div class="w-full mt-6 text-center " id="ModuleExam">

            </div>
        @else
            <p>Ya has completado este módulo.</p>
        @endif

        @if (session('status'))
            <script>
                alert("{{ session('status') }}");
            </script>
        @endif
        <div id="chargeContainer" class="flex items-center justify-center h-screen">
            <div class="w-32 h-32 border-t-4 border-b-4 border-gray-500 rounded-full animate-spin"></div>
        </div>
    </div>
</div>
<!-- Ventana emergente para el video -->
<div id="ModuleVideo" class="video-popup">
    <iframe width="560" height="315" src='' frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen></iframe>
    <span id="close-popup" class="close-btn">x</span>
</div>
