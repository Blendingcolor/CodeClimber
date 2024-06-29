<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Cursos de {{ $user->username }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center mb-4">Cursos de {{ $user->username }}</h1>
        @if($courses->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                            @php
                                $profile = App\Models\Profile::where('user_id', $user->id)->first();
                                $moduleProfile = App\Models\ModuleProfile::where('profile_id', $profile->id)->first();
                            @endphp
                            <tr>
                                <td><img src="{{ $course->image }}" class="img-thumbnail" alt="{{ $course->name }}"></td>
                                <td>{{ $course->name }}</td>
                                <td>{{ $moduleProfile->start_date }}</td>
                                <td>{{ $moduleProfile->end_date }}</td>
                                <td>
                                    <a href="{{ route('usuario.proyecto', [$user->id, $course->id]) }}" class="btn btn-success">Proyecto</a>
                                    <a href="{{ route('usuarios.cursos.modulos', ['user_id' => $user->id, 'course_id' => $course->id]) }}" class="btn btn-primary">Módulos</a>
                                    <a href="#" class="btn btn-danger">Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{route('usuarios')}}" class="btn btn-secondary">Volver a la lista de Usuarios</a>
            </div>
        @else
            <p class="text-center">No hay cursos asignados.</p>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
