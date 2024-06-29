<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/styleHome.css">
    <link rel="icon" href="/images/iconoLogo.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="flex items-center justify-center h-full text-white bg-black bodyHomeUsers">
    <div class="flex flex-row items-center w-full contenedorAll">
        <header id="ventanaEmergente" class="z-10 flex flex-col items-center justify-center w-40 h-screen menuHomeUsers max-sm:w-20">
              
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" id="botonActivar" class="w-[3rem] h-[3rem] bg-transparent bg-gradient-to-br from-opacity-10 to-transparent backdrop-blur-lg rounded-full shadow-lg flex justify-center items-center text-[#FFFF44] hover:text-[#8C8C8D] duration-100 relative animacionEspera sm:hidden size-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
            </svg>

            <nav id="menuHome" class="flex flex-col items-center justify-center w-full h-full max-sm:hidden">
                <a href="{{route('home.index')}}"><img class="w-auto h-[3rem] mb-4" src="/images/iconoLogo2.png" alt=""></a>  
                
                <x-botons.boton href="https://discord.com/" class="hover:text-[#FFFF44] w-[90%] h-[3rem] hover:translate-x-5">
                    <i class="bi bi-discord"></i>
                    <h3>Discord</h3>
                </x-botons.boton>
                <x-botons.boton href="https://github.com/" class="hover:text-[#FFFF44] w-[90%] h-[3rem] hover:translate-x-5">
                    <i class="bi bi-bug-fill"></i>
                    <h3>Error</h3>
                </x-botons.boton>
                {{-- tt --}}
                <x-botons.boton href="{{ route('home.index')}}" class="hover:text-[#FFFF44] w-[90%] h-[3rem] hover:translate-x-5">
                    <i class="bi bi-pencil-fill"></i>
                    <h3>Mis Cursos</h3>
                </x-botons.boton>
                
                <x-botons.boton href="{{route('catalogo')}}" class="hover:text-black hover:bg-[#FFFF44] border border-[#FFFF44] text-[#FFFF44] w-[90%] h-[3rem] hover:translate-x-5">
                    <i class="bi bi-bag-check-fill"></i>
                    <h3>Cursos</h3>
                </x-botons.boton>
                <x-botons.boton href=" {{-- {{ route('userDashboard') }} --}}" class="w-[90%] h-[3rem] bg-[#FFFF44] text-black hover:text-[#18181B] hover:translate-x-5">
                    <h3>RESULTADOS</h3>
                </x-botons.boton>
                @yield('menus')
            </nav>
            <div class="fixed z-20 perfil top-5 right-5">
                <a href="#" class="w-[4rem] h-[4rem] bg-transparent bg-gradient-to-br from-opacity-10 to-transparent backdrop-blur-lg rounded-full border border-opacity-20 border-white shadow-lg flex justify-center items-center text-white hover:text-[#FFFF44] hover:border-[#FFFF44] hover:border-2 duration-100 relative">
                    <i class="text-[2rem] bi bi-person-fill"></i>  
                    {{-- <img class="absolute inset-0 object-cover w-full h-full rounded-full" src="/img/logo.webp" alt=""> --}}
                </a>
            </div>
        </header>

        <main class="flex items-center justify-center w-full h-full ml-40 max-sm:ml-0">
                @yield('contenido')
        </main>
        <script src="/js/app.js"></script>
    </div>
</body>
</html>
