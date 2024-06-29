@php
    $LogoStyles = 'w-[13vw] md:w-[20vw] select-auto hover:scale-125 transition duration-600 border-white dark:border-gray-500 dark:border-opacity-20 rounded-full hover:border-8 border-opacity-20';
    $infoButton = 'h-fit border-2 p-3 text-[1.8vw] font-mono md:text-[2.7vw] us:text-[4vw] rounded-xl transition-colors';
@endphp

<div class="h-full">
    <div id="index" class="h-full grid grid-rows-[32%,32%,32%] grid-cols-[33.3%,16.6%,16.6%,16.6%,16.6%] lg:grid-rows-[35%,20%,20%,21%] items-center place-items-center pt-6 px-8">
        <!-- COLUMNA 1 : Información -->
        <section class="col-start-1 col-end-4 pb-[3%] lg:col-start-1 lg:col-end-6 leading-[1.1] ss:leading-[1.2] select-none">
            <button id="buttonDarkMode" class="text-black dark:text-white font-bold p-1 bg-white dark:bg-black border-2 border-gray-400 rounded-xl">
                LIGHT MODE
            </button>
            <h1 class="text-[3.5vw] lg:text-[5.5vw] md:text-[5vw] us:text-[8vw]">
                DESBLOQUEA TUS <span class="text-orange-500 font-bold text-[4.5vw] lg:text-[6.5vw] md:text-[6vw] us:text-[9vw]">HABILIDADES</span> COMO <span class="text-sky-500 font-bold text-[4.5vw] lg:text-[6.5vw] md:text-[6vw] us:text-[9vw]">PROGRAMADOR</span> DEL LENGUAJE DE TU AGRADO
            </h1>
        </section>

        <section class="h-full top-0 col-start-1 col-end-3 font-thin lg:col-start-1 lg:col-end-6 lg:row-start-2 lg:row-end-3 select-none">
            <!-- Ignorar error falso de codigo -->
            <h2 class="pt-[10px] text-[2.1vw] font-light lg:text-[3.6vw] md:text-[3.2vw] sm:text-[5.2vw] leading-[1.1] font-['Roboto',sans-serif]">
                Aprende lenguajes que te permitan entender más acerca de la programación mediante los cursos gratuitos e interactivos que ofrecemos para despertar tu interés
            </h2>
        </section>

        <div class="flex h-full flex-row space-x-4 col-start-1 col-end-3 row-start-3 row-end-3 lg:col-start-1 lg:col-end-6 lg:row-start-4 lg:row-end-4 text-xl items-start justify-center lg:items-center">
            <button class="{{ $infoButton }} text-white bg-opacity-50 bg-yellow-500 hover:bg-opacity-80 border-yellow-500 duration-200">Ingresa ahora</button>
            <button class="{{ $infoButton }} text-white bg-white bg-opacity-25 border-white border-opacity-30 hover:bg-opacity-50 duration-200">Ver más</button>
        </div>

        <!-- COLUMNA 2: CURSOS -->
        @auth
            <div class="col-start-5 col-end-6 row-start-1 row-end-2 lg:col-start-1 lg:col-end-2 lg:row-start-3 lg:row-end-3 logo">
                <a class="redirectButton" href="{{ route('course.show', ['courseId' => 1]) }}">
                    <img src="{{ asset('images/HtmlLogo.webp') }}" alt="LogoHTML" class="{{ $LogoStyles }}" />
                </a>
            </div>

            <div class="col-start-4 col-end-5 row-start-2 row-end-3 lg:col-start-2 lg:col-end-4 lg:row-start-3 lg:row-end-3 logo">
                <a class="redirectButton" href="{{ route('course.show', ['courseId' => 2]) }}">
                    <img src="{{ asset('images/CSSLogo.webp') }}" alt="LogoCSS" class="{{ $LogoStyles }}" />
                </a>
            </div>

            <div class="col-start-5 col-end-6 row-start-3 row-end-4 lg:col-start-4 lg:col-end-6 lg:row-start-3 lg:row-end-3 logo">
                <a class="redirectButton" href="{{ route('course.show', ['courseId' => 3]) }}">
                    <img src="{{ asset('images/JavaScriptLogo.webp') }}" alt="Logo JavaScript" class="{{ $LogoStyles }}" />
                </a>
            </div>
        @endauth

        @guest
            <div class="col-start-5 col-end-6 row-start-1 row-end-2 lg:col-start-1 lg:col-end-2 lg:row-start-3 lg:row-end-3 logo">
                <a class="redirectButton" href="{{ route('login.show') }}">
                    <img src="{{ asset('images/HtmlLogo.webp') }}" alt="LogoHTML" class="{{ $LogoStyles }}" />
                </a>
            </div>

            <div class="col-start-4 col-end-5 row-start-2 row-end-3 lg:col-start-2 lg:col-end-4 lg:row-start-3 lg:row-end-3 logo">
                <a class="redirectButton" href="{{ route('login.show') }}">
                    <img src="{{ asset('images/CSSLogo.webp') }}" alt="LogoCSS" class="{{ $LogoStyles }}" />
                </a>
            </div>

            <div class="col-start-5 col-end-6 row-start-3 row-end-4 lg:col-start-4 lg:col-end-6 lg:row-start-3 lg:row-end-3 logo">
                <a class="redirectButton" href="{{ route('login.show') }}">
                    <img src="{{ asset('images/JavaScriptLogo.webp') }}" alt="Logo JavaScript" class="{{ $LogoStyles }}" />
                </a>
            </div>
        @endguest

    </div>
</div>