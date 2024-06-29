<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <h1>Home</h1>
    @auth
        @foreach ($courses as $course)
        <li>
            <a href="{{route('course.show', $course->id)}}"> {{ $course->name }} </a>
        </li>
        @endforeach
        <br>
        <p>Bienvenido {{auth()->user()->username}},estas autenticado, para salir presiona <a href="/logout">logout</a></p>  
        <a href="/">home</a>    
    @endauth
    @guest
        <p>Para ver el contenido inicia sesion<a href="{{route('auth.login')}}">login</a></p>
    @endguest
</body>
</html>