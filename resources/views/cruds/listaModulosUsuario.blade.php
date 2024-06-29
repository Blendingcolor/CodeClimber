<!-- resources/views/cruds/listaModulosUsuario.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Módulos Completados por {{ $user->username }}</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center mb-4">Módulos Completados por {{ $user->username }} para el Curso de {{ $course->name }}</h1>
        @if($completedModules->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Descripcion</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($completedModules as $module)
                            <tr>
                                <td>{{ $module->descripcion }}</td>
                                <td>Aprobado</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h2>Modulos Completados: {{ $completedModules->count() }}</h2>
                <h2>Modulos Restantes: {{ $remainingModulesCount }}</h2>
            </div>
        @else
            <p class="text-center">No hay módulos completados para este curso.</p>
            <h2>Modulos Completados: {{ $completedModules->count() }}</h2>
            <h2>Modulos Restantes: {{ $remainingModulesCount+1 }}</h2>
        @endif
        <a href="{{ route('usuarios.inscritos', ['user_id' => $user->id]) }}" class="btn btn-secondary mt-3">Volver a la lista de Cursos</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

