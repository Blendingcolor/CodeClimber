<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Course</title>
    <script>
        function showAlert() {
            alert('Por favor, complete el examen del módulo anterior antes de continuar.');
        }
    </script>
</head>
<body>
    @auth
    <h1>Welcome to course {{$course->name}}</h1>
    <br>
    @foreach($modulesD as $moduleD)
        @php
            $module = $moduleD['module'];
            $moduleA = $moduleD['accessible'];
        @endphp
        @if ($moduleA)
            <a href="{{ route('module.show', ['course' => $course->id, 'module' => $module->id]) }}">{{ $module->descripcion }}</a><br>
        @else
            <a href="#" onclick="showAlert()">{{ $module->descripcion }}</a><br>
        @endif
    @endforeach
    <p><strong>Description: </strong>{{$course->description}}</p>
    <a href="{{ route('home.index') }}">Back to Home</a>
    @endauth

    @guest
        <p>Para ver el contenido inicia sesión <a href="{{route('auth.login')}}">login</a></p>
    @endguest

</body>
</html>
