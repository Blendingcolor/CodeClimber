<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Section</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Edit Section</h1>
        <form action="{{ route('actualizarContenido', ['curso_id' => $curso->id, 'id' => $modulo->id, 'section_id' => $section->id, 'content_id' => $content->id])}}" method="POST">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="text" class="form-label">Texto</label>
                <input type="text" class="form-control" id="text" name="text" value="{{ $content->text }}">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Imagen</label>
                <input type="text" class="form-control" id="image" name="image" value="{{ $content->image }}">
            </div>
            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input type="text" class="form-control" id="code" name="code" value="{{ $content->code }}">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Seccion</button>
        </form>
        <a href="{{route('crudscursos.section', ['curso_id' => $curso->id, 'id' => $modulo->id])}}" class="btn btn-secondary mt-3">Volver a la lista de secciones</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
