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
            $paintedStars = 0;
            $decimalScore = $finalScore / $allQuestions;
        @endphp
        @if ($decimalScore <= 0.2)
            <h1 class="text-center preguntaTitulo mt-8 text-[#FFFF44] text-4xl font-bold">¿Acaso fallaste todas las
                preguntas?
            </h1>
            @php
                $paintedStars = 1;
            @endphp
        @elseif ($decimalScore > 0.2 && $decimalScore <= 0.4)
            <h1 class="text-center preguntaTitulo mt-8 text-[#FFFF44] text-4xl font-bold">Pareces becerra</h1>
            @php
                $paintedStars = 2;
            @endphp
        @elseif ($decimalScore > 0.4 && $decimalScore <= 0.6)
            <h1 class="text-center preguntaTitulo mt-8 text-[#FFFF44] text-4xl font-bold">Buen intento</h1>
            @php
                $paintedStars = 3;
            @endphp
        @elseif ($decimalScore > 0.6 && $decimalScore <= 0.8)
            <h1 class="text-center preguntaTitulo mt-8 text-[#FFFF44] text-4xl font-bold">Bien hecho</h1>
            @php
                $paintedStars = 4;
            @endphp
        @else
            <h1 class="text-center preguntaTitulo mt-8 text-[#FFFF44] text-4xl font-bold">Excelente trabajo</h1>
            @php
                $paintedStars = 5;
            @endphp
        @endif
        <section class="flex flex-row items-center justify-around w-full">
            @for ($i = 0; $i < $paintedStars; $i++)
                <i class="text-[60px] max-sm:text-[40px] lg:text-[80px] xl:text-[100px] text-[#FFFF44] bi bi-star-fill">
                </i>
            @endfor
            @for ($i = 0; $i < 5 - $paintedStars; $i++)
                <i class="text-[60px] max-sm:text-[40px] lg:text-[80px] xl:text-[100px] text-black bi bi-star-fill">
                </i>
            @endfor
        </section>

        @if ($status == 'Aprobado')
            <h1 class="text-3xl font-semibold text-green-500 animate-bounce">Haz {{ $status }}...</h1>
        @else
            <h1 class="text-3xl font-semibold text-red-600 animate-pulse">¡Haz {{ $status }}!</h1>
        @endif
        <a class="flex justify-center w-full " href={{ route('course.show', ['courseId' => $courseId]) }}>
            <button
                class="font-medium flex items-center justify-center text-lg rounded-[10px] bg-[#FFFF44] duration-500 text-black mb-4 h-[3rem] sm:hover:scale-[1.05] w-[40%] ">
                Volver al curso
            </button>
        </a>
    </main>

</body>

</html>
