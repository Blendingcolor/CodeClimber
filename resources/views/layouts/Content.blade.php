@auth
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Curso @yield('NombreCurso')</title>
        <!-- Agregar aquí la inclusión de los estilos CSS -->
        <link rel="stylesheet" href="{{ asset('css/content.css') }}">
        <link rel="stylesheet" href="{{ asset('css/prism.css') }} ">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        @vite('resources/css/app.css')
        <script>
            function showAlert() {
                alert('Por favor, complete todos los exámenes de los módulos antes de acceder al proyecto.');
            }
        </script>
    </head>

    <body
        class="overflow-x-hidden relative h-screen w-screen text-white grid grid-cols-[20%,70%,10%] grid-rows-[15%-85%] place-items-center">
        <!-- Lista de Cursos -->
        <aside id="coursesSection"
            class="z-20 flex flex-col w-full h-full col-span-1 p-2 transition-all duration-150 bg-black bg-opacity-85 text-start lg:absolute lg:w-full lg:h-full lg:bg-opacity-90 lg:col-span-full lg:justify-center lg:items-center lg:top-2/4 lg:left-2/4 lg:-translate-x-2/4 lg:-translate-y-2/4">
            <!-- Botón para volver al home -->
            <div class="flex flex-col items-center justify-center w-full py-10 ">
                <a class="flex justify-center p-2 transition-colors duration-150 border-0 rounded-full hover:bg-white hover:bg-opacity-20"
                    href="{{ route('home.index') }}">
                    <img class="w-8 hover:animate-pulse-faster" src="{{ asset('images/icons/back.svg') }}" alt="BackIcon">
                </a>
            </div>
            <div class= "flex flex-col items-start justify-center lg:items-center lg:w-3/4 lg:z-10 ">

                <!-- Primer div: Modulo -->
                <div class="w-full pr-2 space-y-4">
                    @php
                        $contador = 1;
                    @endphp
                    <!-- Sub módulos: Uso de componentes de clase-->
                    @foreach ($course->modules as $module)
                        @php
                            $sectionIds = [];
                            $sectionNames = [];
                        @endphp

                        @foreach ($module->sections as $section)
                            @php
                                array_push($sectionNames, $section->name);
                                array_push($sectionIds, $section->id);
                            @endphp
                        @endforeach
                        <x-modulo :moduleId="$contador" :moduleName="$module->descripcion" :subModuleNames="$sectionNames" :subModuleIds="$sectionIds" />
                        @php
                            $contador += 1;
                        @endphp
                    @endforeach
                    @if ($allModulesApproved)
                        @if ($v_proyect)
                            <a href="#" id="project-link">Proyecto Enviado</a>
                        @else
                            <a href="{{ route('projecto.view', ['course_id' => $course->id]) }}" id="project-link">Proyecto</a>
                        @endif
                    @else
                            <a href="#" onclick="showAlert()">Proyecto</a>
                    @endif
                </div>
            </div>
        </aside>

        <!-- Contenido del módulo -->
        <main id="contentSection"
            class="relative flex flex-col items-center w-full h-screen col-span-2 transition-all duration-150 border-l-2 border-white lg:border-transparent lg:col-span-full">
            <div class="w-full h-full subModule">
                <div id="submodule-content" class="hidden">
                    @yield('moduleContent')
                </div>
                <button id="closeSectionButton"
                    class="absolute left-0 z-20 transition-all duration-150 bg-white border-4 border-white rounded-full top-2/4 -translate-x-2/4 -translate-y-2/4 lg:translate-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="black" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </button>
            </div>
        </main>
        <!-- Icono e información del perfil de usuario -->
        <div class="fixed z-20 perfil top-5 right-5">
            <a href="#"
                class="w-[4rem] h-[4rem] bg-transparent bg-gradient-to-br from-opacity-10 to-transparent backdrop-blur-lg rounded-full border border-opacity-20 border-white shadow-lg flex justify-center items-center text-white hover:text-[#FFFF44] hover:border-[#FFFF44] hover:border-2 duration-100">
                <i class="text-[2rem] bi bi-person-fill"></i>
            </a>
        </div>

    </body>
    <script src="{{ asset('js/prism.js') }}"></script>
    <script>
        //Solicitud AJAX para el contenido de los módulos: (No tocar)
        let courseData = @json($jsonData);
        let modules = @json($modulesD);
        let exam = @json($exam);

        $(document).ready(function() {
            $('.module-button').click(function() {

                let moduleId = $(this).data('id');
                let section = courseData.course.modules[moduleId - 1].sections;

                // Función para crear y añadir un bloque de código
                function createCodeField(codeContent) {
                    let codeBlock = document.createElement('pre');
                    let codeElement = document.createElement('code');
                    codeElement.className = 'language-javascript line-numbers';
                    codeElement.textContent = codeContent;
                    codeBlock.appendChild(codeElement);
                    return codeBlock;
                }

                // Verificar accesibilidad del módulo
                if (!modules[moduleId - 1].accessible) {
                    alert('No tienes acceso a este módulo.');
                    return;
                }

                const target = this.getAttribute('data-target');
                const submodule = document.getElementById(target);

                // Ocultar todos los submódulos, excepto el submódulo seleccionado
                document.querySelectorAll('[id^="submodule-"]').forEach(sub => {
                    if (sub.id !== target) {
                        sub.classList.add('hidden');
                    }
                });

                // Mostrar/ocultar el submódulo seleccionado
                submodule.classList.toggle('hidden');

                const submoduleContent = document.getElementById('submodule-content');
                submoduleContent.classList.remove('hidden');

                let chargeContainer = document.querySelector("#chargeContainer");
                if (chargeContainer) {
                    chargeContainer.classList.remove('hidden');
                }

                $.ajax({
                    url: '/home/course/1',
                    method: 'GET',
                    success: function(data) {
                        // Limpiar el contenido existente antes de agregar nuevo contenido
                        $('#sections').html('');

                        // Agregar el encabezado del módulo
                        $('#sections').append(
                            `<h1 class="text-4xl font-extrabold text-center">${courseData.course.modules[moduleId - 1].descripcion}</h1>`
                        );

                        // Iterar sobre las secciones del módulo y agregarlas dinámicamente
                        section.forEach((sec, i) => {
                            if (sec.type === "normal") {
                                // Insertar sección normal
                                $('#sections').append(
                                    `<div>
                            <h1 id="${sec.id}" class="text-2xl font-extrabold">${sec.name}</h1>
                            <div id="sectionContent" class="flex flex-col justify-between text-md">
                                <br>
                                <p>${escapeHtml(sec.content.text)}</p>
                                <br>
                                ${sec.content.image ? `<div class="flex justify-center w-full imageContainer">
                                                                            <img src="${sec.content.image}" class="w-60">
                                                                        </div>` : ''}
                                ${sec.content.code ? `<div class="codeContainer">
                                                                            <pre><code class="language-javascript line-numbers">${sec.content.code}</code></pre>
                                                                        </div>` : ''}
                            </div>
                        </div>`
                                );
                            } else if (sec.type === "nota") {
                                // Insertar sección de nota
                                $('#sections').append(
                                    `<div class="flex flex-col items-center w-full">
                            <div class="relative w-5/6 p-4 border-2 rounded-md bg-white/5 border-white/5">
                                <h1 id="${sec.id}" class="flex flex-row items-center justify-center text-xl font-bold text-center">${sec.name}</h1>
                                <div id="sectionContent" class="flex flex-col justify-between text-md">
                                    <br>
                                    <p>${escapeHtml(sec.content.text)}</p>
                                    <br>
                                    ${sec.content.image ? `<div class="flex flex-row justify-center w-full imageContainer">
                                                                                <img src="${sec.content.image}" class="w-60">
                                                                            </div>` : ''}
                                    ${sec.content.code ? `<div class="codeContainer">
                                                                                <pre><code class="language-javascript line-numbers">${sec.content.code}</code></pre>
                                                                            </div>` : ''}
                                </div>
                                <div class="absolute top-[-15px] left-[-15px] w-10">
                                    <img class="hover:cursor-help" src="{{ asset('images/icons/information.svg') }}" alt="informationIcon">
                                </div>
                            </div>
                        </div>`
                                );
                            } else if (sec.type === "codigo" && sec.content.code) {
                                // Crear y añadir bloque de código
                                let codeBlock = createCodeField(sec.content.code);
                                $('#sections').append(codeBlock);
                            } else if (sec.type === "actividad") {
                                // Insertar sección de actividad
                                $('#sections').append(
                                    `<div class="flex flex-col space-y-4">
                            <h2 id="${sec.id}" class="text-xl font-bold text-start">${sec.name}</h2>
                            <div id="sectionContent" class="flex flex-col justify-between text-sm border-t-2 text-start border-white/5">
                                <br>
                                <p>${sec.content.text}</p>
                                <button class="hover:text-sky-700 hover:underline" onclick="openCodeEditor()" target="_blank">Demo en nueva pestaña</button>
                            </div>
                        </div>`
                                );
                            }
                            // Tipos adicionales en caso de que se agreguen...
                        });

                        // Después de insertar todos los bloques de código, resaltar usando Prism.js
                        Prism.highlightAll();

                        // Configurar el reproductor de video
                        $('#ModuleVideo iframe').attr('src',
                            'https://www.youtube.com/embed/CLkxRnRQtDE?start=1');

                        // Configurar eventos del reproductor de video y enlaces
                        setupVideo();
                        setupExamLink(moduleId);

                        // Ocultar el elemento de carga
                        if (chargeContainer) {
                            chargeContainer.classList.add('hidden');
                        }

                        // Marcar módulos como activos
                        modulesActive = true;

                    },
                    error: function(xhr, status, error) {
                        // Manejar errores de la solicitud AJAX
                        $('#sections').html('<p>Error: ' + xhr.responseJSON.error + '</p>');

                        if (chargeContainer) {
                            chargeContainer.classList.add('hidden');
                        }
                    }

                });

                // Función para escapar caracteres HTML
                function escapeHtml(unsafe) {
                    return unsafe
                        .replace(/&/g, "&amp;")
                        .replace(/</g, "&lt;")
                        .replace(/>/g, "&gt;")
                        .replace(/"/g, "&quot;")
                        .replace(/'/g, "&#039;");
                }

                // Función para configurar el reproductor de video
                function setupVideo() {
                    const videoButton = document.getElementById('video-button');
                    const videoPopup = document.getElementById('ModuleVideo');
                    const closePopup = document.getElementById('close-popup');
                    const iframe = videoPopup.querySelector('iframe');
                    const videoUrl = iframe.src;

                    videoButton.addEventListener('click', () => {
                        videoPopup.style.display = 'block';
                        iframe.src = videoUrl;
                    });

                    closePopup.addEventListener('click', () => {
                        videoPopup.style.display = 'none';
                        iframe.src = "";
                    });
                }

                // Función para configurar el enlace al examen
                function setupExamLink(moduleId) {
                    let moduleExamLink =
                        "{{ route('exam.question', ['course' => $course->id, 'module' => 'MODULE_ID', 'exam' => 'EXAM_ID', 'index' => 1]) }}";
                    moduleExamLink = moduleExamLink.replace('MODULE_ID', courseData.modulesD[moduleId - 1]
                        .module.id);
                    moduleExamLink = moduleExamLink.replace('EXAM_ID', courseData.course.modules[moduleId -
                        1].exam.id);
                    $('#ModuleExam').html(
                        `<a class="p-2 transition-all border-2 border-white rounded-md bg-gray-600/25 hover:bg-gray-500/50 hover:rounded-lg" href="${moduleExamLink}" onclick="return confirm('¿Estás seguro de que deseas ver el examen?');"> Dar examen </a><br>`
                    );
                }
            });
        });

        const closeSectionButton = document.querySelector('#closeSectionButton');
        const coursesSection = document.querySelector('#coursesSection');
        const contentSection = document.querySelector('#contentSection');
        let closed = true; // Cambia a true porque inicialmente la sección de módulos está cerrada

        // Función para abrir la sección de módulos
        const whenClickOpenButton = () => {
            coursesSection.classList.toggle('-translate-x-full');
            closeSectionButton.classList.toggle('rotate-180');
            setTimeout(() => {
                closeSectionButton.classList.toggle('translate-x-1');
                coursesSection.classList.toggle('hidden');
                contentSection.classList.toggle('col-span-2');
                contentSection.classList.toggle('col-span-full');
            }, 150);
            closed = false;
        };

        // Función para cerrar la sección de módulos
        const whenClickCloseButton = () => {
            coursesSection.classList.toggle('-translate-x-full');
            closeSectionButton.classList.toggle('rotate-180');
            setTimeout(() => {
                closeSectionButton.classList.toggle('translate-x-1');
                coursesSection.classList.toggle('hidden');
                contentSection.classList.toggle('col-span-2');
                contentSection.classList.toggle('col-span-full');
            }, 150);
            closed = true;
        };

        // Evento para mostrar/ocultar el menú de módulos
        closeSectionButton.addEventListener('click', () => {
            if (closed) {
                whenClickOpenButton();
            } else {
                whenClickCloseButton();
            }
        });

        // Lógica para cambiar y reproducir audio
        const audioButton = document.getElementById('audio-button');
        const audioIcon = document.getElementById('audio-icon');
        let audioPlaying = false;
        audioButton.addEventListener('click', () => {
            const audio = document.getElementById('audio');
            if (!audioPlaying) {
                audio.play();
                audioIcon.classList.remove('fa-volume-up');
                audioIcon.classList.add('fa-volume-mute');
            } else {
                audio.pause();
                audioIcon.classList.remove('fa-volume-mute');
                audioIcon.classList.add('fa-volume-up');
            }
            audioPlaying = !audioPlaying;
        });

        // Código HTML y CSS de ejemplo
        var codigoHTML = ``;

        // Codificar en base64
        var codigoHTMLBase64 = btoa(codigoHTML);

        async function openCodeEditor() {
            // Generar la URL de Plunker con el código preinsertado
            var urlPlunker = 'https://plnkr.co/edit/?p=preview&html=' + encodeURIComponent(codigoHTMLBase64);

            // Redirigir o abrir en una nueva ventana/tab
            window.open(urlPlunker, '_blank');
        }
    </script>

    </html>
@endauth
