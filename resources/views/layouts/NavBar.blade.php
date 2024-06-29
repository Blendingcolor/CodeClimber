<?php 
    $hoverNavText = "group-hover:font-semibold";
    $navFont = "font-mono";
    $navBefore = "relative text-gray-500 hover:text-white"
?>
<!doctype html>
<html lang="es" class="h-screen" id="htmlReference">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="/images/iconoLogo.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
      .nav::after {
        position: absolute;
        content: '';
        background-color: white;
        height: 3px;
        width: 0%;
        position: absolute;
        bottom: -10px;
        left: 0;
        border-radius: 8px;
      }
      .nav:hover::after {
        width: 100%;
        transition-duration: 250ms;
        transition-delay: 25ms;
      }
    </style>
  </head>
  <body class="h-screen text-white bg-black dark:text-black dark:bg-white transition-colors duration-300">
      <div class="h-[10%]">
        <nav class="flex flex-row w-screen py-4 px-6 md:py-2 md:px-3 ss:px-2">
          <div class="w-[10%]">
            <!-- IMAGEN SVG-->
            <a class=" bg-white navLogo" href="/"><img class="w-[3.5rem]" src="/images/iconoLogo2.png" alt=""></a>
          </div>
          <ul
            class="
              flex w-[70%] justify-around {{$navFont}} text-[1.4vw] lg:text-[3.1vw]  items-center ss:text-[10px]
              {{$hoverNavText}} 
            "
          >
            <li>
              <a href="#" class="{{$navBefore}} tracking-[1px] nav">About us</a>
            </li>
            <li>
              <a href="#" class="{{$navBefore}} tracking-[1px] nav">Blog</a>
            </li>
            <li>
              <a href="#" class="{{$navBefore}} tracking-[1px] nav">Donate</a>
            </li>
          </ul>
          <ul
            class="w-[20%] font-semibold flex p-1 justify-end space-x-3 items-center 
            text-center lg:bg-yellow-400 lg:hover:shadow-lg lg:hover:shadow-yellow-400 
            lg:border-2 lg:rounded-md lg:hover:rounded-xl lg:hover:text-black 
            lg:transition-all lg:duration-300 lg:cursor-pointer lg:justify-center text-[1.3vw] lg:text-[2.3vw] sm:text-xs ss:text-[10px] {{$navFont}}"
          >
            @auth
            <li>
              <a href="{{route('home.index')}}">Más cursos</a>
            </li>
            @endauth
            @guest
            <li><a href="/login">Log in</a></li>
            <li
              class="p-1 text-white font-semibold bg-yellow-400 hover:shadow-lg
              hover:shadow-yellow-400 border-2 rounded-md hover:rounded-xl 
              hover:text-black transition-all duration-300 cursor-pointer lg:hidden"
            >
              <a href="register">Sign up</a>
            </li>
            @endguest
          </ul>
        </nav>
      </div>
      <div class="h-[90%] flex items-center">
          @yield("NavBarContent")
      </div>
  </body>
  <script>
    
    //Funcion para aplicar/desactivar el modo noche del index

    const boton = document.getElementById("buttonDarkMode");
    const logos = document.querySelectorAll(".logo");

        let estado = false;

        boton.addEventListener("click", function() {
            if (!estado) {
                boton.classList.add("bg-black");
                boton.textContent = "DARK MODE";
                document.documentElement.classList.add("dark");
                estado = true;
            } else {
                boton.classList.remove("bg-black");
                boton.classList.add("bg-white");
                boton.textContent = "LIGHT MODE";
                document.documentElement.classList.remove("dark");
                estado = false;
            }
        });

        window.addEventListener("load", function() {
            logos.forEach(logo => {
                logo.classList.remove("hidden");
                logo.classList.add("block");
            });
        });

        function showAlert() {
            alert('Por favor, complete el examen del módulo anterior antes de continuar.');
        }
  </script>
</html>



