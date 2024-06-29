<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalles de la Seccion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">{{ $modulo->descripcion }}</h1>
        <p>Modulo: {{ $modulo->id }}</p>

        <div class="p-5 table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Tipo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sections as $section)
                        @php
                            $content = $section->content;
                        @endphp
                        <tr>
                            <td>{{ $section->name }}</td>
                            <td>{{ $section->type }}</td>
                            <td>
                                <form action="{{ route('crudcursos.section.destroy', ['curso_id' => $curso->id, 'id' => $modulo->id, 'section_id' => $section->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                                <a href="{{ route('editarContenido', ['curso_id' => $curso->id, 'id' => $modulo->id, 'section_id' => $section->id, 'content_id' => $content->id]) }}" class="btn btn-info btn-sm">Cotenido</a>
                                <a href="{{ route('crudscursos.section.edit', ['curso_id' => $curso->id, 'id' => $modulo->id, 'section_id' => $section->id]) }}" class="btn btn-warning btn-sm">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Botón para abrir el modal de agregar módulo -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarSeccion">Agregar Seccion</button><br>
        <a href="{{ route('crudscursos.mostrar', ['id' => $curso->id]) }}" class="btn btn-secondary mt-3">Volver a la lista de modulo</a>
    </div>

    <!-- Modal de agregar módulo -->
    <div class="modal fade" id="modalAgregarSeccion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Módulo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('crudscursos.section.create', ['curso_id' => $curso->id, 'id' => $modulo->id]) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Tipo</label>
                            <input type="text" class="form-control" name="type" id="type" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar Seccion</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
