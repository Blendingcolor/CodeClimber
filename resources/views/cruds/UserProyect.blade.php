<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center mb-4">Proyecto de {{ $user->username }} para el Curso de {{ $course->name }}</h1>
        @if($project)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $project->title }}</h5>
                    <p class="card-text">{{ $project->description }}</p>
                    <a href="{{ $project->Github_Enlace }}">Enlace a Github</a>
                </div>
            </div>
        @else
            <p class="text-center mt-3">El usuario no ha subido un proyecto para este curso.</p>
            
        @endif
        <a href="{{ route('usuarios.inscritos', ['user_id' => $user->id]) }}" class="btn btn-secondary mt-3">Volver al listado de cursos inscritos</a>
        
        @if($project)
        <form id="form-aprobado" action="{{ route('usuario.aprobo', ['user_id' => $user->id, 'course_id' =>$course->id]) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success mt-3">Aprobado</button>
        </form>

        <form id="form-desaprobado" action="{{ route('usuario.desaprobo', ['user_id' => $user->id, 'course_id' =>$course->id])}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger mt-3">Desaprobado</button>
        </form>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>