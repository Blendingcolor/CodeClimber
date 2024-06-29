<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <title>Preguntas y Respuestas</title>
</head>

<body class="flex items-center justify-center h-full text-white bg-black">
    <div class="container text-center h-screen w-[90%] flex flex-col justify-center items-center">
        <h2 class="mb-8 text-3xl font-bold">{{ $exam->descripcion }}</h2>
        <div class="w-full">
            <h3 class="mb-4 text-2xl">Pregunta {{ $index }}: {{ $question->question }}</h3>
            <form method="POST"
                action="{{ route('exam.submit', ['course' => $course->id, 'module' => $module->id, 'exam' => $exam->id, 'index' => $index]) }}"
                class="w-full">
                @csrf
                <ul class="grid grid-cols-1 gap-4 mb-5 md:grid-cols-2">
                    @foreach ($question->alternatives as $alternative)
                        <li
                            class="alternative text-[#8C8C8D] hover:text-[#BABABB] h-[10rem] hover:scale-[1.03] duration-150 cursor-pointer flex justify-center items-center rounded-[1rem] bg-[#18181B]">
                            <label class="flex items-center justify-center w-full h-full cursor-pointer">
                                <input type="radio" name="alternative_id" value="{{ $alternative->id }}"
                                    class="hidden peer">
                                <span
                                    class="flex items-center justify-center w-full h-full">{{ $alternative->alternative }}</span>
                            </label>
                        </li>
                    @endforeach
                </ul>
                <div class="flex flex-col items-center justify-around mb-5">
                    @if ($index < $allQuestions)
                        <button
                            class="nextButton font-medium flex items-center justify-around rounded-[10px] bg-[#FFFF44]/30 duration-400 p-2 text-black mb-4 h-[3rem] w-[20rem] lg:h-[5rem] cursor-not-allowed"
                            type="submit" disabled>Siguiente</button>
                    @else
                        <button
                            class="nextButton font-medium flex items-center justify-around rounded-[10px] bg-[#FFFF44]/30 duration-400 p-2 text-black mb-4 h-[3rem] w-[20rem] max-sm:w-full lg:h-[5rem] cursor-not-allowed"
                            type="submit" name="finish" disabled>Finish the exam</button>
                    @endif
                </div>
                <div class="barra w-full bg-[#18181B] rounded-full h-[0.5rem] top-[1rem]">
                    <div class="right-0 w-{{"$index/$allQuestions * 100".'%'}} rounded-full bg-[#FFFF44] h-full"></div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

<script>
    let nextButton = document.querySelectorAll(".nextButton");
    document.addEventListener("DOMContentLoaded", function() {
        const alternatives = document.querySelectorAll(".alternative");

        alternatives.forEach(alternative => {
            const input = alternative.querySelector("input");

            input.addEventListener("change", () => {
                alternatives.forEach(alt => {
                    alt.classList.remove("bg-[#FFFF44]");
                    alt.children[0].children[1].classList.remove("text-black");
                });
                if (input.checked) {
                    alternative.children[0].children[1].classList.add("text-black");
                    alternative.classList.add("bg-[#FFFF44]");
                    nextButton.forEach(button => {
                        button.disabled = false;
                        button.classList.add("sm:hover:scale-[1.05]",
                            "cursor-pointer", "bg-[#FFFF44]");
                        button.classList.remove("cursor-not-allowed",
                            "bg-[#FFFF44]/30");
                    });
                }
            });
        });
    });
</script>
