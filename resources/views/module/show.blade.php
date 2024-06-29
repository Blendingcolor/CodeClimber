<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <h1>{{$module->descripcion}}</h1><br>
    <h1> {{ $content->text }} </h1>
    <img src="{{ $content->image }}" alt="image" title="image"><br>
    <a href="{{ route('exam.question', ['course' => $course->id, 'module' => $module->id, 'exam' => $module->exam->id, 'index' => 1]) }}" 
        onclick="return confirm('¿Estás seguro de que deseas ver el examen?');">
         See the exam
     </a><br>
    <a href="{{ route('course.show', ['course' => $course->id]) }}">Back to Course</a>
    @if (session('status'))
        <script>
            alert("{{ session('status') }}");
        </script>
    @endif
</body>
</html>