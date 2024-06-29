<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href={{ asset('css/style.css') }}>
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <title>Resultado</title>
</head>

<body class="flex items-center justify-center h-screen text-white bg-black">
    <main class=" w-[80%] h-[40%] lg:h-[60%] bg-[#18181B] rounded-[20px] flex flex-col justify-between items-center">
        @php
            $paintedStars = min(max($moduloClasificado + 1, 1), 5);
        @endphp
        @if ($paintedStars == 1)
            <h1 class="text-center preguntaTitulo mt-8 text-[#FFFF44] text-4xl font-bold">¿Acaso fallaste todas las preguntas?, parece que no tienes conocimientos previos.</h1>
        @elseif ($paintedStars == 2)
            <h1 class="text-center preguntaTitulo mt-8 text-[#FFFF44] text-4xl font-bold">Pareces becerra, parece que no tienes mucho conocimientos previos.</h1>
        @elseif ($paintedStars == 3)
            <h1 class="text-center preguntaTitulo mt-8 text-[#FFFF44] text-4xl font-bold">Buen intento, parece que tienes un poco de conocimiento previo.</h1>
        @elseif ($paintedStars == 4)
            <h1 class="text-center preguntaTitulo mt-8 text-[#FFFF44] text-4xl font-bold">Bien hecho, parece que tienes algo de conocimiento.</h1>
        @else
            <h1 class="text-center preguntaTitulo mt-8 text-[#FFFF44] text-4xl font-bold">Excelente trabajo, parece que ya tienes conocimiento del curso.</h1>
        @endif

        <section class="flex flex-row items-center justify-around w-full">
            @for ($i = 0; $i < $paintedStars; $i++)
                <i class="text-[60px] max-sm:text-[40px] lg:text-[80px] xl:text-[100px] text-[#FFFF44] bi bi-star-fill"></i>
            @endfor
            @for ($i = 0; $i < 5 - $paintedStars; $i++)
                <i class="text-[60px] max-sm:text-[40px] lg:text-[80px] xl:text-[100px] text-black bi bi-star-fill"></i>
            @endfor
        </section>

        <!-- Botón para volver al curso -->
        <a class="flex justify-center w-full" href="{{ route('home.index') }}">
            <button class="mb-8 duration-100 font-medium flex items-center justify-around rounded-[10px] bg-[#FFFF44] p-2 text-black h-[3rem] sm:hover:scale-[1.05] w-[20rem] max-sm:w-[80%] xl:w-[70%]">
                Volver al curso
            </button>
        </a>
    </main>
</body>
</html>
