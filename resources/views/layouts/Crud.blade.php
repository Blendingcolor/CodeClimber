<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>
    <link rel="icon" href="/images/iconoLogo.png" type="image/png">
    <link rel="stylesheet" href="/css/styleHome.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite('resources/css/app.css')
</head>
{{-- bg-gradient-to-b from-black to-black --}}
<body class="w-screen h-screen pt-10 mx-auto text-white bg-black">
    <header>
        @yield('agregarNav')
        <h1 class="mb-4 text-5xl font-extrabold text-center font-crud text-jsColor-0">@yield('nombreCrud')</h1>
    </header>

    <!-- Modal de Registrar datos -->
    <section id="modalRegistrar" class="pb-4 w-[90%] mx-auto">
        <input type="checkbox" id="insertBox" class="hidden peer">
        @yield('insertar')  <!-- Campo de inserción de datos -->
    </section>

    <main class="w-[90%] mx-auto relative">
        <table class="z-10 min-w-full p-4 rounded-xl">
            <thead class="text-3xl font-title bg-[#18181B] ">
                <tr class="">
                    @yield("columnas") <!-- Campo de columnas -->
                </tr>
            </thead>
            <tbody class="text-xl bg-[#18181B] border-none font-text">
                @yield("datos") <!-- Campo de datos de la tabla -->
            </tbody>
        </table>
    </main>
</body>
    <script src="js/app.js"></script>
    @yield('script')
</html>
